<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Judul dan periode
$judul = 'HISTORY STOCK BARANG';
$periode = (isset($tglAwal) && isset($tglAkhir))
    ? 'Periode: ' . date('d-m-Y', strtotime($tglAwal)) . ' s/d ' . date('d-m-Y', strtotime($tglAkhir))
    : '';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('History Stock Barang');

// Judul
$sheet->setCellValue('A1', $judul);
$sheet->mergeCells('A1:G1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Periode
$sheet->setCellValue('A2', $periode);
$sheet->mergeCells('A2:G2');
$sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(11);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Header kolom
$headers = [
    'No', 'Tanggal', 'Nama Barang', 'Quantity In', 'Quantity Out', 'Harga Satuan', 'Total In'
];
$headerRow = 4;
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . $headerRow, $header);
    $col++;
}

// Style header
$sheet->getStyle("A{$headerRow}:G{$headerRow}")->applyFromArray([
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
$grand_total_in = 0;
foreach ($data as $d) {
    $total_in = $d->qtt_in * $d->harga;
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, date('d-m-Y', strtotime($d->tgl)));
    $sheet->setCellValue('C' . $row, $d->nama_brg);
    $sheet->setCellValue('D' . $row, $d->qtt_in);
    $sheet->setCellValue('E' . $row, $d->qtt_out);
    $sheet->setCellValue('F' . $row, $d->harga);
    $sheet->setCellValue('G' . $row, $total_in);

    // Format angka
    $sheet->getStyle('D' . $row . ':E' . $row)->getNumberFormat()->setFormatCode('#,##0');
    $sheet->getStyle('F' . $row . ':G' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

    $grand_total_in += $total_in;
    $row++;
}

// Baris total
$sheet->setCellValue('F' . $row, 'Total Nilai Barang Masuk:');
$sheet->setCellValue('G' . $row, $grand_total_in);
$sheet->getStyle("F{$row}:G{$row}")->getFont()->setBold(true);
$sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

// Border seluruh tabel
$lastDataRow = $row;
$sheet->getStyle("A{$headerRow}:G{$lastDataRow}")
    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

// Auto width
foreach (range('A', 'G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Footer info
$footerRow = $row + 2;
$sheet->setCellValue('A' . $footerRow, 'Laporan dihasilkan pada: ' . date('d-m-Y H:i:s'));
$sheet->mergeCells('A' . $footerRow . ':G' . $footerRow);
$sheet->getStyle('A' . $footerRow)->getFont()->setItalic(true)->setSize(9);

// Print area & page setup
$sheet->getPageSetup()->setPrintArea('A1:G' . $footerRow);
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);

// Header/footer
$sheet->getHeaderFooter()
    ->setOddHeader('&C&B' . $judul)
    ->setOddFooter('&L&B' . $sheet->getTitle() . '&R&P dari &N');

// Output ke browser
$filename = 'History_Stock_Barang_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>