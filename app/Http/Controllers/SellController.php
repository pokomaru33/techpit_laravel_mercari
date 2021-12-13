<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SellController extends Controller
{
    //
    public function showSellForm()
    {
        // $categories = PrimaryCategory::orderBy('sort_no')->get();
        $categories = PrimaryCategory::query()
            ->with([
                'secondaryCategories' => function($query){
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();


        $conditions = ItemCondition::orderBy('sort_no')->get();
        return view('sell')
            ->with('categories', $categories)
            ->with('conditions', $conditions);
    }

    public function sellItem(SellRequest $request)
    {
        $user = Auth::user();

        $imageName = $this->saveImage($request->file('item-image'));

        $item                        = new Item();
        $item->seller_id             = $user->id;
        $item->image_file_name       = $imageName;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        $item->state                 = Item::STATE_SELLING;
        $item->save();

        return redirect()->back()
        ->with('status', '商品を出品しました。');
    }

    /**
     * 画像リサイズと保存
     * @return string fileパス
     */
    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();
        Image::make($file)->fit(300,300)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('item-images', new File($tempPath));

        return basename($filePath);
    }

     /**
      * 一時的なファイルを生成してパスを返します。
      *
      * @return string ファイルパス
      */
      private function makeTempPath(): string
      {
          $tmp_fp = tmpfile();
          $meta   = stream_get_meta_data($tmp_fp);
          return $meta["uri"];
      }
}
