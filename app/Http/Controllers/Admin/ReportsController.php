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
    $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    }
    elseif ($Schedule != 'null' && $exp_date != null && $dm == 'null') {
        $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm('false')->withSched($Schedules);
    }elseif ($Schedule != 'null' && $exp_date != null && $dm != 'null') {
        $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
    ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
    ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm($orders)->withSched($Schedules);
        }
    }elseif ($Schedule == 'null' && $exp_date != null && $dm == 'null') {
      
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm('false')->withSched($Schedules);
       
    }elseif ($Schedule == 'null' && $exp_date != null && $dm != 'null') {
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm($orders)->withSched($Schedules);
        }
    }elseif ($Schedule == 'null' && $exp_date == null && $dm != 'null') {
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm($orders)->withSched($Schedules);
        }
    }elseif ($Schedule != 'null' && $exp_date == null && $dm != 'null') {
        $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])
    ->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
    ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
    ->select('orders.*', 'users.name as cname')
    ->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm($orders)->withSched($Schedules);
           
        }
    }else{
        return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm('false')->withSched($Schedules);
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
      $row = 2;
      foreach ($datas as $keys=>$item) {
        $row +=$keys;
        $activeWorksheet->setCellValue('A'.$row, $item['Title']);
        $activeWorksheet->setCellValue('B'.$row, $item['Exp_date']);
        $activeWorksheet->setCellValue('C'.$row, $item['stock']);
        $activeWorksheet->setCellValue('D'.$row, $item['batch']);  
         
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
          $row = 2;
          foreach ($datas as $keys=>$item) {
            $row +=$keys;
            $activeWorksheet->setCellValue('A'.$row, $item['Title']);
            $activeWorksheet->setCellValue('B'.$row, $item['Exp_date']);
            $activeWorksheet->setCellValue('C'.$row, $item['stock']);
            $activeWorksheet->setCellValue('D'.$row, $item['batch']);  
             
          }
            $writer = new Xlsx($spreadsheet);
            $writer->save('Product Report.xlsx');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Product Expairy Report.xlsx"');
            header('Cache-Control: max-age=0');
       }

       // for day month

       if($type == "dm"){
        $activeWorksheet->setCellValue('A1', 'ID');
        $activeWorksheet->setCellValue('B1', 'Customer Name');
        $activeWorksheet->setCellValue('C1', 'Order Value');
        $activeWorksheet->setCellValue('D1', 'Total Gst');
        $activeWorksheet->setCellValue('E1', 'Discount');
          $row = 2;
          foreach ($datas as $keys=>$item) {
            $row +=$keys;
            $activeWorksheet->setCellValue('A'.$row, $item['id']);
            $activeWorksheet->setCellValue('B'.$row, $item['cname']);
            $activeWorksheet->setCellValue('C'.$row, $item['Total_Order']);
            $activeWorksheet->setCellValue('D'.$row, $item['Total_Gst']); 
            $activeWorksheet->setCellValue('E'.$row, $item['Discount']); 
             
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
}
