<?php

namespace App\Http\Controllers;

use App\Statistics;
use App\Words;
use App\Reports;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\WordValidation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WordsController extends Controller
{
    private $adminMiddleware = ['getReportedWords'];
    private $guestMiddleware = ['getReportedWords'];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('guest', ['only' => $this->guestMiddleware]);
        $this->middleware('admin', ['only' => $this->adminMiddleware]);
    }

    /**
     * Show all the words.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $Data['title']    = Lang::get('words.');
        $Data['query']    = Words::paginate(7);
        // $Data['reported'] = Reports::where('user_id', '=', Auth::user()->id)->get();

        return view('client.words', $Data);
    }

    /**
     * Search for a specific word
     *
     * @return \Illuminate\View\View
     */
    public function searchWord()
    {
        $term = Input::get('searchterm');

        $stmt = Words::where('word', '=', $term);
        $stmt->orWhere('word_an', '=', $term);
        $stmt->orWhere('dialect', '=', $term);

        $Data['title']    = Lang::get('words.');
        $Data['query']    = $stmt->paginate(15);
        // $Data['reported'] = Reports::where('user_id', '=', Auth::user()->id)->get();

        return view('client.words', $Data);

    }

    /**
     * Show a specific word.
     *
     * @return \Illuminate\View\View
     */
    public function specificWord($id)
    {
        $Data['title'] = Lang::get('words.');
        $Data['query'] = Words::where('id', '=', $id)->get();

        return view('', $Data);
    }

    /**
     * Throw a word in the report DB Table.
     *
     * @todo Make unit test because i have no time now.
     * @param $id
     * @return mixed
     */
    public function reportWord($id)
    {
        $value['word_id'] = $id;
        $value['user_id'] = Auth::user()->id;

        $report = Reports::create($value);

        if ($report) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        }

        return Redirect::back()->with($notification);

    }

    /**
     * Get the view for all the reported words
     *
     * @return \Illuminate\View\View
     */
    public function getReportedWords()
    {
        $Data['title'] = Lang::get('');
        $Data['query'] = '';

        return view('', $Data);
    }

    public function ViewInsertWord()
    {
        $Data['title'] = Lang::get('');
        return view('client.insertWord', $Data);
    }

    /**
     * Insert view for a new word.
     *
     * @param WordValidation $input
     * @return mixed
     */
    public function PostInsertWord(WordValidation $input)
    {
        $wordValues = [
            'dialect'     => $input->dialect,
            'word_an'     => $input->wordAN,
            'description' => $input->description,
            'user_id'     => Auth::user()->id,
            'region_id'   => 0,
        ];

        $word       = Words::create($wordValues);
        $id = Auth::user()->id;

        DB::statement("UPDATE Statistics SET words_inserted = words_inserted + 1 WHERE id = $id ");

        if ($word) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('words.');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('words.');
        }

        return Redirect::back()->with($notification);
    }

    /**
     * Show the form for updating a word.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function ViewUpdateWord($id)
    {
        $Data['title'] = Lang::get('');
        $Data['query'] = Words::find($id);

        return view('', $Data);
    }

    /**
     * Update a word in the database.
     *
     * @param $id
     * @return mixed
     */
    public function PostUpdateWord($id)
    {
        $query = Reports::find($id);

        if ($query->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        }

        return Redirect::back()->with($notification);
    }

    /**
     * Delete a word out of the database.
     *
     * @param $id
     * @return mixed
     */
    public function deleteWord($id)
    {
        $Words = Words::destroy($id);

        if ($Words > 0) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('words.');
            $notification['message'] = Lang::get('words.');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('words.');
            $notification['message'] = Lang::get('words.');
        }

        return Redirect::back()->with($notification);
    }

}
