<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Judul dan periode
$judul = 'HISTORY PENERIMAAN BARANG';
$periode = (isset($tglAwal) && isset($tglAkhir))
    ? 'Periode: ' . date('d-m-Y', strtotime($tglAwal)) . ' s/d ' . date('d-m-Y', strtotime($tglAkhir))
    : '';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('History Penerimaan');

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
    'No', 'Tanggal', 'Kode Barang', 'Nama Barang', 'Group',
    'Total Masuk', 'Satuan', 'Harga', 'Total'
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
$totalNilai = 0;

foreach ($data as $d) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, date('d-m-Y', strtotime($d->tgl)));
    $sheet->setCellValue('C' . $row, $d->kode_brg);
    $sheet->setCellValue('D' . $row, $d->nama_brg);
    $sheet->setCellValue('E' . $row, $d->nama_group);
    $sheet->setCellValue('F' . $row, $d->qtt_in);
    $sheet->setCellValue('G' . $row, $d->nama_satuan);
    $sheet->setCellValue('H' . $row, $d->harga);
    $sheet->setCellValue('I' . $row, $d->total_price_in);

    // Format angka
    $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
    $sheet->getStyle('H' . $row . ':I' . $row)->getNumberFormat()->setFormatCode('#,##0');

    $totalQty += $d->qtt_in;
    $totalNilai += $d->total_price_in;
    $row++;
}

// Baris total
$sheet->setCellValue('E' . $row, 'Total:');
$sheet->setCellValue('F' . $row, $totalQty);
$sheet->setCellValue('H' . $row, 'Total Nilai:');
$sheet->setCellValue('I' . $row, $totalNilai);
$sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
$sheet->getStyle('I' . $row)->getNumberFormat()->setFormatCode('#,##0');
$sheet->getStyle("E{$row}:I{$row}")->getFont()->setBold(true);

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
$filename = 'History_Penerimaan_Barang_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>