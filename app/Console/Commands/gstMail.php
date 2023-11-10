<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use  App\Models\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;



class gstMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gst:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::now()->toDateString();

        $order = Order::whereDate('created_at', now()->toDateString())
        ->orderBy('created_at', 'asc')
        ->get();
       

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();


        $activeWorksheet->setCellValue('A1', 'Invoice No');
            $activeWorksheet->setCellValue('B1', 'Order Date');
            $activeWorksheet->setCellValue('C1', 'Total GST');
            $activeWorksheet->setCellValue('D1', 'Total Amount');
            $row = 2;
            foreach ($order as $keys=>$item) {
                $row +=$keys;
                $activeWorksheet->setCellValue('A'.$row, $item->orderID);
                $activeWorksheet->setCellValue('B'.$row, $item->created_at);
                $activeWorksheet->setCellValue('C'.$row, $item->Total_Gst);
                $activeWorksheet->setCellValue('D'.$row, $item->Total_Order);  
                
            }

            $filePath = public_path('gst/'.$currentDate.'_report.xlsx');

            $writer = new Xlsx($spreadsheet);
            $writer->save($filePath);
        
        // return Command::SUCCESS;
        Mail::send("gstmail",[],function($message) use($currentDate){
          $message->to('tripathiarupkumar@gmail.com')
          ->subject('Daily GST Report')
          ->attach('http://medshop.test/gst/'.$currentDate.'_report.xlsx');
        });

        
    }
}
