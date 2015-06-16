<?php

namespace App\Http\Controllers;

use App\Statistics;
use App\Words;
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
    private $guestMiddleware = ['getReportedWords', 'PostInsertWord'];

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
        $Data['title'] = Lang::get('words.');
        $Data['query'] = Words::paginate(15);

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

        $Data['title'] = Lang::get('words.');
        $Data['query'] = $stmt->get();

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
     * @param $id
     * @return mixed
     */
    public function reportWord($id)
    {
        $query          = new Reports;
        $query->word_id = $id;

        if ($query->save()) {

        } else {

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

        DB::statement("
              UPDATE Statistics
              SET words_inserted = words_inserted + 1
              WHERE id = $id)
            ");

        if ($word > 0) {
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
     * @return \Illuminate\View\View
     */
    public function ViewUpdateWord()
    {
        $Data['title'] = Lang::get('');
        $Data['query'] = '';

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

        } else {

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
