<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    private $_client;
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost:3000/',
            'exceptions' => false,
        ]);
    }

    public function index()
    {
        //Mengambil data area
        $result = $this->_client->request('GET', 'area');        
        $data = json_decode($result->getBody()->getContents(), true);

        //Mengambil data chart
        $results = $this->_client->request('GET', 'search');        
        $datas = json_decode($results->getBody()->getContents(), true);

        //Mengambil data table
        $resultr = $this->_client->request('GET', 'search/table');        
        $datar = json_decode($resultr->getBody()->getContents(), true);

        $dataChart = [];
        foreach($datas['data'] as $dt){
            $dataChart[] = array(
                "name" => $dt['area_name'],
                "y" => floatval($dt['Presentase'])
            );
        }

        return view('main.home', [
            'area' => $data,
            'data' => json_encode($dataChart),
            'table' => $datar,
            'page' => 'Home',
            'title' => 'Home',
            'modul' => 'Page Home'
        ]);
        
    }

    function searchdata(Request $request)
    {
        $request->validate([
            'area' => 'required',
        ]);

        $area = trim($request->input('area'));
        $st = trim($request->input('datestart'));
        $fn = trim($request->input('datefinish'));

        if(!empty($st)){
            $start = date_create($st);  
            $start1 = date_format($start,"Y-m-d"); 
        }else{
            $start1 = "";
        }

        if(!empty($fn)){
            $finish = date_create($fn);  
            $finish1 = date_format($finish,"Y-m-d"); 
        }else{
            $finish1 = "";
        }
        
        // Chart
        $results = $this->_client->request('POST', 'search', [
            'json' => [
                'area' => $area,
                'start' => $start1,
                'finish' => $finish1
            ]            
        ]);        
        $datas = json_decode($results->getBody()->getContents(), true);

        $dataChart = [];
        foreach($datas['data'] as $dt){
            $dataChart[] = array(
                "name" => $dt['area_name'],
                "y" => floatval($dt['Presentase'])
            );
        }

        //Table
        $resultr = $this->_client->request('POST', 'search/table', [
            'json' => [
                'area' => $area,
                'start' => $start1,
                'finish' => $finish1
            ]            
        ]);        
        $datar = json_decode($resultr->getBody()->getContents(), true);

        return view('main.homeentry', [
            'data' => json_encode($dataChart),
            'table' => $datar,
            'page' => 'Home',
            'title' => 'Home',
            'modul' => 'Page Home'
        ]);
    }
}
