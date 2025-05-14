<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Judul dan periode
$judul = 'HISTORY BARANG KELUAR';
$periode = (isset($tglAwal) && isset($tglAkhir))
    ? 'Periode: ' . date('d-m-Y', strtotime($tglAwal)) . ' s/d ' . date('d-m-Y', strtotime($tglAkhir))
    : '';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('History Barang Keluar');

// Judul
$sheet->setCellValue('A1', $judul);
$sheet->mergeCells('A1:I1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Periode
$sheet->setCellValue('A2', $periode);
$sheet->mergeCells('A2:I2');
$sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(11);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Header kolom
$headers = [
    'No', 'Tanggal', 'No DO', 'Customer', 'Kode Barang',
    'Nama Barang', 'Group', 'Jumlah Keluar', 'Satuan'
];
$headerRow = 4;
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . $headerRow, $header);
    $col++;
}

// Style header
$sheet->getStyle("A{$headerRow}:I{$headerRow}")->applyFromArray([
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4472C4'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
]);
$sheet->getRowDimension($headerRow)->setRowHeight(20);

// Data
$row = $headerRow + 1;
$no = 1;
$totalQty = 0;
foreach ($data as $d) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, !empty($d->tanggal) ? date('d/m/Y', strtotime($d->tanggal)) : '-');
    $sheet->setCellValue('C' . $row, $d->no_do ?? '');
    $sheet->setCellValue('D' . $row, $d->customer ?? '');
    $sheet->setCellValue('E' . $row, $d->kode_barang ?? $d->kode_brg ?? '');
    $sheet->setCellValue('F' . $row, $d->nama_barang ?? $d->nama_brg ?? '');
    $sheet->setCellValue('G' . $row, $d->group ?? $d->nama_group ?? '');
    $sheet->setCellValue('H' . $row, $d->jumlah_keluar ?? $d->jumlah ?? $d->qtt_out ?? 0);
    $sheet->setCellValue('I' . $row, $d->satuan ?? $d->nama_satuan ?? '');

    // Format angka
    $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');

    $totalQty += ($d->jumlah_keluar ?? $d->jumlah ?? $d->qtt_out ?? 0);
    $row++;
}

// Baris total
$sheet->setCellValue('G' . $row, 'Total Quantity:');
$sheet->setCellValue('H' . $row, $totalQty);
$sheet->getStyle("G{$row}:H{$row}")->getFont()->setBold(true);

// Border seluruh tabel
$lastDataRow = $row;
$sheet->getStyle("A{$headerRow}:I{$lastDataRow}")
    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

// Auto width
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Footer info
$footerRow = $row + 2;
$sheet->setCellValue('A' . $footerRow, 'Laporan dihasilkan pada: ' . date('d-m-Y H:i:s'));
$sheet->mergeCells('A' . $footerRow . ':I' . $footerRow);
$sheet->getStyle('A' . $footerRow)->getFont()->setItalic(true)->setSize(9);

// Print area & page setup
$sheet->getPageSetup()->setPrintArea('A1:I' . $footerRow);
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);

// Header/footer
$sheet->getHeaderFooter()
    ->setOddHeader('&C&B' . $judul)
    ->setOddFooter('&L&B' . $sheet->getTitle() . '&R&P dari &N');

// Output ke browser
$filename = 'History_Barang_Keluar_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
