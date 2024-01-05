<?php

namespace App\Livewire\Page;

use App\Models\User;
use Livewire\Component;
use App\Models\Assigned;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Border;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\CellAlignment;

class Teacher extends Component
{
    use WithFileUploads;
    #[Validate(['required'])]
    public $csvFile;
    public function teacherStudents() {
        $student = Assigned::leftJoin('users', function ($join) {
            $join->on('users.id', '=', 'assigneds.student_id')
                ->where('users.role', '=', 'student');
        })
        ->select(
            'assigneds.student_id',
            'users.name',
            'users.email',
            'users.dob',
            'assigneds.score',
            'assigneds.status',
            'assigneds.created_at'
        )
        ->where('assigneds.teacher_id', '=', Auth::user()->id)
        ->get();

        return $student; 
    }

    public function exportCSV() {
        $students = $this->teacherStudents(); 

        $border = new Border(
            new BorderPart(Border::BOTTOM, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::TOP, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID)
        );
        
        $style = (new Style()) 
            ->setFontSize(10)
            ->setFontColor(Color::BLACK)
            ->setShouldWrapText() 
            ->setBorder($border); 

        $writer = SimpleExcelWriter::streamDownload('students.xlsx');
        foreach ($students as $student) {
            $writer->addRow([
                'student_id' => $student->student_id,
                'name' => $student->name,
                'score' => ''
            ], $style);
        }

        SimpleExcelWriter::create(
            file: 'students.xlsx',
            configureWriter: function ($writer) {
                $options = $writer->getOptions(); 
                $options->setColumnWidth(100, 2); 
        });

        $writer->toBrowser(); 
    }

    public function importCSV() {
        $this->validate(); 
        $tempFilePath = $this->csvFile->getRealPath(); 
        $rows = SimpleExcelReader::create($tempFilePath)->getRows();

        $rows->each(function(array $row) {
            $studentId = $row['student_id'];
            $score = (int)$row['score'];
            $status = ($score >= 5) ? 'passed' : 'failed';

            Assigned::where('student_id', $studentId)->update([
                'score' => $score,
                'status' => $status
            ]);
        }); 

        $this->addError('csvSuccess', 'Import Success.');
    }

    public function logout () {
        Auth::logout();
        return redirect('login');
    }

    public function render()
    { 
        return view('livewire.page.teacher', [
            'students' => $this->teacherStudents()
        ]);
    }
}
