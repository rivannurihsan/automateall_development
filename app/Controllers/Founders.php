<?php namespace App\Controllers;

class Founders extends BaseController
{	
    public function showLinktree(){
        if(empty($_GET['name'])){
            $name = "";
        } else {
            $name = strtolower($_GET['name']);
        }
        $subkhan = [
            'ava' => 'subkhan.jpg',
            'nama' => 'Subkhan Ibnu Aji',
            'about' => 'Hi, call me Subkhan. I am <strong>Founder</strong> and <strong>Chief Executive Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/ibnuzx/',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/ibnuzx/',
            'email'=>'subkhanibnuaji@automateall.id',
            'wa'=>'http://wa.me/+6281291735442'
        ];
        $alkahfi = [
            'ava' => 'alkahfi.jpg',
            'nama' => 'Muhammad Alkahfi Khuzaimy Abdullah',
            'about' => 'Hi, call me Alkahfi. I am <strong>Co-Founder</strong> and <strong>Chief Information Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/muhammad-alkahfi-1850a4188',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/alkahfi_khuzaimy/',
            'email'=>'alkahfi@automateall.id',
            'wa'=>'http://wa.me/+6281808931753'
        ];
        $irfan = [
            'ava' => 'irfan.jpg',
            'nama' => 'Irfan Nugraha',
            'about' => 'Hi, call me Irfan. I am <strong>Co-Founder</strong> and <strong>Chief Product Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/irfan-nugraha-9987211bb',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/irfan_ngrh/',
            'email'=>'irfannugraha@automateall.id',
            'wa'=>'http://wa.me/+6282140310174'
        ];
        $belva = [
            'ava' => 'belva.jpg',
            'nama' => 'Belva Rabbani Driantama',
            'about' => 'Hi, call me Belva. I am <strong>Co-Founder</strong> and <strong>Chief Operation Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/belva-rabbani-driantama',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/belvadriantama/',
            'email'=>'belvarabbani@automateall.id',
            'wa'=>'http://wa.me/+6282297063243'
        ];
        $mar = [
            'ava' => 'mar.jpg',
            'nama' => 'Mar Ayu Fotina',
            'about' => 'Hi, call me Mar. I am <strong>Co-Founder</strong> and <strong>Chief Design Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/mar-ayu-fotina-098a4a1b9',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/marayufotina/',
            'email'=>'marayufotina@automateall.id',
            'wa'=>'http://wa.me/+62895340613031'
        ];
        $annas = [
            'ava' => 'annas.jpg',
            'nama' => 'Annas Wahyu Ramadhan',
            'about' => 'Hi, call me Annas. I am <strong>Co-Founder</strong> and <strong>Chief Technology Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/awramadhan',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/annaswramadhan/',
            'email'=>'annaswahyu@automateall.id',
            'wa'=>'http://wa.me/+6282243060075'
        ];
        $dicky = [
            'ava' => 'dicky.jpg',
            'nama' => 'Dicky Prasetiyo',
            'about' => 'Hi, call me Dicky. I am <strong>Co-Founder</strong> and <strong>Chief Science Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://linkedin.com/in/dicky-prasetiyo-8a47611ab',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/heydickyp/',
            'email'=>'dickyprasetiyo@automateall.id',
            'wa'=>'http://wa.me/+6281324845227'
        ];
        $naufal = [
            'ava' => 'naufal.jpg',
            'nama' => 'Dzaky Naufal Ramadhan',
            'about' => 'Hi, call me Naufal. I am <strong>Co-Founder</strong> and <strong>Chief Financial Officer</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://www.linkedin.com/in/dzakynr',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/iamfaal/',
            'email'=>'naufal@automateall.id',
            'wa'=>'http://wa.me/+628998888779'
        ];
        $adel = [
            'ava' => 'adel.jpg',
            'nama' => 'Adelia Puspa Kirana',
            'about' => 'Hi, call me Adel. I am <strong>Investor Relation</strong> of Automate All. Follow me through some of
          the links below...',
            'linkedin' => 'https://linkedin.com/in/adelia-puspa-kirana-887710184',
            'porto'=>'',
            'ig'=>'https://www.instagram.com/deliadea/',
            'email'=>'adel@automateall.id',
            'wa'=>'http://wa.me/+6281323329814'
        ];
        
        
        switch ($name) {
            case 'subkhan':
                return view("pages/founder_detail",$subkhan);
                break;
            case 'alkahfi':
                return view("pages/founder_detail",$alkahfi);
                break;
            case 'irfan':
                return view("pages/founder_detail",$irfan);
                break;
            case 'belva':
                return view("pages/founder_detail",$belva);
                break;
            case 'mar':
                return view("pages/founder_detail",$mar);
                break;
            case 'annas':
                return view("pages/founder_detail",$annas);
                break;
            case 'dicky':
                return view("pages/founder_detail",$dicky);
                break;
            case 'naufal':
                return view("pages/founder_detail",$naufal);
                break;
            case 'adel':
                return view("pages/founder_detail",$adel);
                break;
            default:
                return view("pages/founder_detail");
                break;
        }
    }
}