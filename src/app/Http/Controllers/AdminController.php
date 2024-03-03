<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use League\Csv\Writer;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        $gender = $request->gender;
        $category_id = $request->category_id;
        $created_at = $request->created_at;

        $contacts = Contact::ContactSearch($gender, $category_id, $created_at)
                ->KeywordSearch($request->keyword)
                ->paginate(7);

        return view('admin', compact('contacts'));
    }

    public function getContact()
    {
        $contacts = Contact::paginate(7);
        return view('admin', compact('contacts'));
    }

    /*public function create()
    {
        $genderOptions = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        $categoryOptions = [
            1 => '商品のお届けについて',
            2 => '商品の交換について',
            3 => '商品トラブル',
            4 => 'ショップへのお問い合わせ',
            5 => 'その他',
        ];

        return view('admin', compact('genderOptions', 'categoryOptions'));
    }*/

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('admin/export');
    }

    public function exportCSV()
    {
        $contacts = $this->getCurrentContacts();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(array_keys($contacts->first()->toArray()));

        foreach ($contacts as $contact) {
            $csv->insertOne($contact->toArray());
        }

        $fileName = 'export.csv';

        $csv->output($fileName);
    }

    private function getCurrentContacts()
    {
    $keyword = request()->input('keyword');
    $gender = request()->input('gender');
    $category_id = request()->input('category_id');
    $created_at = request()->input('created_at');

    if ($keyword) {
        $query = Contact::query();
        $query->where('last_name', 'like', "%$keyword%")
            ->orWhere('first_name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%");

        if ($gender || $category_id || $created_at) {
            $query->where(function($q) use ($gender, $category_id, $created_at) {
                if ($gender) {
                    $q->where('gender', $gender);
                }
                if ($category_id) {
                    $q->where('category_id', $category_id);
                }
                if ($created_at) {
                    $q->whereDate('created_at', $created_at);
                }
            });
        }

        return $query->paginate(7);
        }

    return Contact::ContactSearch($gender, $category_id, $created_at)->paginate(7);
    }
}





