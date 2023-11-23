<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use  App\Models\Product;
use App\Models\ProductVeriant;
use  App\Models\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;


use Illuminate\Support\Facades\DB;



use PhpOffice\PhpSpreadsheet\Reader\Exception;

use PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ReportsController extends Controller
{
    public function index()
    {
        
        $Schedule = Schedule::all();
        return view('admin.reports')->with(compact('Schedule'));
        
        
    }


    
    public function export(Request $request)
    {
    $Schedules = Schedule::all();  
    $requestData = $request->all();
    $token = $requestData['_token'];
    
    $Schedule = $requestData['schedule'];
    $exp_date = $requestData['exp_date'];
    $dm = $requestData['day_month'];
    //check
    if($Schedule != 'null' && $exp_date == null && $dm == 'null'){
    // $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    // ->where('products.Schedule', '=', $Schedule)
    // ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    // ->get();
    //     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    
     $sdata =  DB::table('orders')
     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
     ->join('products', 'order_details.product_id', '=', 'products.id')
     ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
     ->where('products.Schedule', '=', $Schedule)
     ->select('products.Title','product_veriant.*', 'orders.orderID')->get();
     
     
     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
   }


   elseif($Schedule == 'null' && $exp_date != null && $dm == 'null'){
    // $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    // ->where('products.Schedule', '=', $Schedule)
    // ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    // 
    //     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    
     $sdata =  DB::table('orders')
     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
     ->join('products', 'order_details.product_id', '=', 'products.id')
     ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
     ->where('orders.created_at', 'like', $exp_date.'%')
     ->select('products.Title','product_veriant.*', 'orders.orderID')->get();
     
     
     return view('admin.reports_exports')->withschedule('false')->withexp($sdata)->withdm('false')->withSched($Schedules);
   }

/*
   elseif($Schedule == 'null' && $exp_date == null && $dm != 'null'){
    // $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    // ->where('products.Schedule', '=', $Schedule)
    // ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    // 
    //     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    
     $sdata =  DB::table('orders')
     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
     ->join('products', 'order_details.product_id', '=', 'products.id')
     ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
     ->where('products.created_at', '=', $dm)
     ->select('products.Title','product_veriant.*', 'orders.orderID')
     

     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
   }


   */


elseif($Schedule == 'null' && $exp_date == null && $dm != 'null'){
  if($dm == '1'){
            $date = date('Y-m-d');
            
            $orders = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
            ->whereDATE('orders.created_at','like',$date)
            ->select('products.Title','product_veriant.*', 'orders.*')->get();
            
                        
            return view('admin.reports_exports')->withschedule("false")->withexp('false')->withdm($orders)->withSched($Schedules);
        }
        else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            
            $orders = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('orders.created_at', [$beforeOneMonth, $date])
            ->select('products.Title', 'product_veriant.*', 'orders.orderID', 'orders.created_at')->get();
            
            //   echo $orders;
                        return view('admin.reports_exports')->withschedule("false")->withexp('false')->withdm($orders)->withSched($Schedules);
        }
        


}



   elseif($Schedule != 'null' && $exp_date != null && $dm == 'null'){
     
    // $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    //   ->where('Exp_date','=',$exp_date)
    //   ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    //   

    $edata = DB::table('orders')
    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    ->join('products', 'order_details.product_id', '=', 'products.id')
    ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->where('orders.created_at', 'like', $exp_date.'%')
    ->select('products.Title','product_veriant.*', 'orders.orderID')->get();
    
       
    return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm('false')->withSched($Schedules);

   }
   
   elseif($Schedule != 'null' && $exp_date != null && $dm != 'null'){
      if($dm == '1'){
                $date = date('Y-m-d');
                
                $orders = DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
                ->where('products.Schedule', '=', $Schedule)
                ->where('orders.created_at', 'like', $exp_date.'%')
                ->whereDATE('orders.created_at','like',$date)
                ->select('products.Title','product_veriant.*', 'orders.*')->get();
                
                                
                return view('admin.reports_exports')->withschedule("false")->withexp('false')->withdm($orders)->withSched($Schedules);
            }
            else{
                $date = date('Y-m-d');
                $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
                
                $orders = DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
                ->where('products.Schedule', '=', $Schedule)
                ->where('orders.created_at', 'like', $exp_date.'%')
                ->whereDATE('orders.created_at', '<=' ,$beforeOneMonth, 'and', 'orders.created_at', '>=' ,$date)
                ->select('products.Title', 'product_veriant.*', 'orders.orderID', 'orders.created_at')->get();
                
                                //   echo $orders;
                return view('admin.reports_exports')->withschedule("false")->withexp('false')->withdm($orders)->withSched($Schedules);
            }
            
 

   }
  

   /*older code
   
   elseif($Schedule != 'null' && $exp_date == null && $dm != 'null'){
    // $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    // ->where('products.Schedule', '=', $Schedule)
    // ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    // 
    //     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    
     $sdata =  DB::table('orders')
     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
     ->join('products', 'order_details.product_id', '=', 'products.id')
     ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
     ->where('products.Schedule', '=', $Schedule)
     ->where('products.created_at', '=', $dm)
     ->select('products.Title','product_veriant.*', 'orders.orderID')
     ->get();
     
     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
   }
   */

   //updated one
   elseif($Schedule != 'null' && $exp_date == null && $dm != 'null'){
   if($dm == '1'){
    $date = date('Y-m-d');
    
    $orders = DB::table('orders')
    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    ->join('products', 'order_details.product_id', '=', 'products.id')
    ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->whereDATE('orders.created_at','like',$date)
    ->select('products.Title','product_veriant.*', 'orders.*')->get();
                    
    return view('admin.reports_exports')->withschedule("false")->withexp('false')->withdm($orders)->withSched($Schedules);
}
else{
    $date = date('Y-m-d');
    $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
    
    $orders = DB::table('orders')
    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    ->join('products', 'order_details.product_id', '=', 'products.id')
    ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->whereBetween('orders.created_at', [$beforeOneMonth, $date])
    ->select('products.Title', 'product_veriant.*', 'orders.orderID', 'orders.created_at')->get();
                    //   echo $orders;
    return view('admin.reports_exports')->withschedule("false")->withexp('false')->withdm($orders)->withSched($Schedules);
}
 }



   elseif($Schedule == 'null' && $exp_date != null && $dm != 'null'){
    // $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    // ->where('products.Schedule', '=', $Schedule)
    // ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    // ->get();
    //     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    
     $sdata =  DB::table('orders')
     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
     ->join('products', 'order_details.product_id', '=', 'products.id')
     ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
     ->where('orders.created_at', 'like', $exp_date.'%')
     ->select('products.Title','product_veriant.*', 'orders.orderID')->get();
     
     return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
   }
   

   elseif ($Schedule == 'null' && $exp_date == null && $dm == 'null') {
    return redirect()->back()->with('error', 'enter any one of these.');
   }
  }


    public function report(Request $request)
{
    $data= $request->all();
    $type = $data['report_type'];
    $datas = json_decode($data['data'], true);


    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    //for schedule
   if($type == "schedule"){
    $activeWorksheet->setCellValue('A1', 'Title');
    $activeWorksheet->setCellValue('B1', 'Exp_date');
    $activeWorksheet->setCellValue('C1', 'Stock');
    $activeWorksheet->setCellValue('D1', 'Batch');
    $activeWorksheet->setCellValue('E1', 'Invoice No');
      $row = 2;
      foreach ($datas as $keys=>$item) {
        $row +=$keys;
        $activeWorksheet->setCellValue('A'.$row, $item['Title']);
        $activeWorksheet->setCellValue('B'.$row, $item['expdate']);
        $activeWorksheet->setCellValue('C'.$row, $item['stock']);
        $activeWorksheet->setCellValue('D'.$row, $item['batch']);  
        $activeWorksheet->setCellValue('E'.$row, $item['orderID']);
         
      }
        $writer = new Xlsx($spreadsheet);
        $writer->save('Product Report.xlsx');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Product Report.xlsx"');
        header('Cache-Control: max-age=0');
   }
    //  for Exp Date 

    if($type == "exp"){
        $activeWorksheet->setCellValue('A1', 'Title');
        $activeWorksheet->setCellValue('B1', 'Exp_date');
        $activeWorksheet->setCellValue('C1', 'Stock');
        $activeWorksheet->setCellValue('D1', 'Batch');
        $activeWorksheet->setCellValue('E1', 'Envoice No');
          $row = 2;
          foreach ($datas as $keys=>$item) {
            $row +=$keys;
            $activeWorksheet->setCellValue('A'.$row, $item['Title']);
            $activeWorksheet->setCellValue('B'.$row, $item['expdate']);
            $activeWorksheet->setCellValue('C'.$row, $item['stock']);
            $activeWorksheet->setCellValue('D'.$row, $item['batch']);  
            $activeWorksheet->setCellValue('E'.$row, $item['orderID']);  
             
          }
            $writer = new Xlsx($spreadsheet);
            $writer->save('Product Report.xlsx');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Product Expairy Report.xlsx"');
            header('Cache-Control: max-age=0');
       }

       // for day month

       if($type == "dm"){
        $activeWorksheet->setCellValue('A1', 'Title');
        $activeWorksheet->setCellValue('B1', 'Exp_date');
        $activeWorksheet->setCellValue('C1', 'Stock');
        $activeWorksheet->setCellValue('D1', 'Batch');
        $activeWorksheet->setCellValue('E1', 'Envoice No');
          $row = 2;
          foreach ($datas as $keys=>$item) {
            $row +=$keys;
            $activeWorksheet->setCellValue('A'.$row, $item['Title']);
            $activeWorksheet->setCellValue('B'.$row, $item['expdate']);
            $activeWorksheet->setCellValue('C'.$row, $item['stock']);
            $activeWorksheet->setCellValue('D'.$row, $item['batch']);  
            $activeWorksheet->setCellValue('E'.$row, $item['orderID']);  
              
             
          }
            $writer = new Xlsx($spreadsheet);
            $writer->save('Product Report.xlsx');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Daily Monthly sales Report.xlsx"');
            header('Cache-Control: max-age=0');
       }
     
    

    
    ob_end_clean();
    $writer->save('php://output');
}


public function gst_report(){
  // echo "hello world";
  // 

  $currentMonth = Carbon::now()->month;

  $order = Order::whereMonth('created_at', $currentMonth)->orderBy('created_at', 'asc')->get();

  return view('admin.gst_reports')->withOrder($order);
}



public function gst_report_export(Request $req){
 

  $spreadsheet = new Spreadsheet();
  $activeWorksheet = $spreadsheet->getActiveSheet();


  $activeWorksheet->setCellValue('A1', 'Invoice No');
    $activeWorksheet->setCellValue('B1', 'Order Date');
    $activeWorksheet->setCellValue('C1', 'Total GST');
    $activeWorksheet->setCellValue('D1', 'Total Amount');
    $row = 2;
    foreach (json_decode($req->data) as $keys=>$item) {
        $row +=$keys;
        $activeWorksheet->setCellValue('A'.$row, $item->orderID);
        $activeWorksheet->setCellValue('B'.$row, $item->created_at);
        $activeWorksheet->setCellValue('C'.$row, $item->Total_Gst);
        $activeWorksheet->setCellValue('D'.$row, $item->Total_Order);  
           
    }

    $writer = new Xlsx($spreadsheet);
            $writer->save('GST Report.xlsx');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="GST Report.xlsx"');
            header('Cache-Control: max-age=0');
     
    ob_end_clean();
    $writer->save('php://output');


}
}

