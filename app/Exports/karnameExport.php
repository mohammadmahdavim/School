<?php

namespace App\Exports;

use App\Models\Detail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BoorsiehExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Detail::where('boorsieh_count', '>', 0)
            ->addSelect('boorsieh_count', 'contract_id', 'group_code')
            ->with(['contract' => function ($query) {
                $query->addSelect('id', 'school_id')
                    ->with(['school.manager' => function ($qu) {
                        $qu->addSelect('name', 'family', 'manager_code');
                    }])
                    ->with(['school.area_branch' => function ($qu) {
                        $qu->addSelect('area_code', 'area_name');
                    }]);
            }])
            ->with(['group' => function ($que) {
                $que->addSelect('group_code', 'group_name');
            }])
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'مرکز',
            'مدیر جذب',
            'کد مدرسه',
            'مدرسه',
            'گروه',
            'تعداد بورسیه',
        ];
    }

    public function map($preflight): array
    {

        return [

            ($preflight->contract->school->area_branch ? $preflight->contract->school->area_branch->area_name : ''),
            ($preflight->contract->school->manager ? $preflight->contract->school->manager->name : '') . ($preflight->contract->school->manager ? $preflight->contract->school->manager->family : ''),
            $preflight->contract->school->school_id,
            $preflight->contract->school->school_name,
            $preflight->group->group_name,
            $preflight->boorsieh_count,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')
            ->getFont()
            ->setBold(true);

        $sheet->getStyle('1')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE);

        $sheet->getStyle('A1:Z9999')
            ->getAlignment()
            ->setWrapText(true);


    }

}
