<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JournalController extends Controller
{
 public function menu_journal(){
	  $journal = DB::select("select journalname as name,title as title,url as url,author as author,document as document from journal_publication order by id desc ");
	  $heading = "LIST OF JOURNAL PUBLICATIONS";
	  $type='JOURNAL';
                return view('front_end/menu_journalView',compact('journal','heading','type'));
    }
public function menu_book(){
	  $journal = DB::select("select papername as name,title as title,url as url,author as author,document as document from book_publication order by id desc ");
            $heading = "LIST OF BOOK PUBLICATIONS";
	  $type='BOOK';
                return view('front_end/menu_journalView',compact('journal','heading','type'));
    }
public function menu_patent(){
	  $journal = DB::select("select patentno as name,title as title,url as url,author as author,document as document from patent order by id desc");
	   $heading = "LIST OF PATENT";
	  $type='PATENT NO';
                 return view('front_end/menu_journalView',compact('journal','heading','type'));
    }
	public function menu_mou(){
	  $data = DB::select("select mou.*,research_fellow.name as rf from mou join research_fellow on research_fellow.id=mou.research_fellow where category='Mou' order by from_date desc");
	  $heading = "LIST OF MOU";
	  
                return view('front_end/menu_mouView',compact('data','heading'));
    }
	public function menu_project(){
	  $data = DB::select("select mou.*,research_fellow.name as rf from mou join research_fellow on research_fellow.id=mou.research_fellow where category='Project' order by from_date desc");
	  $heading = "LIST OF PROJECT";
	  
                return view('front_end/menu_mouView',compact('data','heading'));
    }
	public function menu_fellowship(){
	  $data = DB::select("select mou.*,research_fellow.name as rf from mou join research_fellow on research_fellow.id=mou.research_fellow where category='Fellowship' order by from_date desc");
	  $heading = "LIST OF FELLOWSHIP";
	  
                return view('front_end/menu_mouView',compact('data','heading'));
    }
	public function menu_grant(){
	  $data = DB::select("select mou.*,research_fellow.name as rf from mou join research_fellow on research_fellow.id=mou.research_fellow where category='Grants' order by from_date desc");
	  $heading = "LIST OF GRANTS";
	  
                return view('front_end/menu_mouView',compact('data','heading'));
    }
	public function teaching_method(){
	  $teachingmethod = DB::select("select * from teaching_method group by faculty_id order by method='Group learning /Discussion' or method='Online Teaching Method' or method='Peer teaching' or method='Practical demonstrations' desc");

                return view('front_end/menu_teachingmethod',compact('teachingmethod'));
    }
}