<?php


namespace App\Helper;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class CustomController extends Controller
{
    protected $validationRules = [];

    protected $validationMessage = [];

    /** @var Request $request */

    /**
     * CustomController constructor.
     */
    public function __construct()
    {
    }

    public function checkValidation(Request $request)
    {
        $data = $request->all();

        return Validator::make($data, $this->getValidationRules(), $this->getValidationMessage());
    }

    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * @param mixed $validationRules
     *
     * @return CustomController
     */
    public function setValidationRules($validationRules)
    {
        $this->validationRules = $validationRules;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidationMessage()
    {
        return $this->validationMessage;
    }

    /**
     * @param mixed $validationMessage
     *
     * @return CustomController
     */
    public function setValidationMessage($validationMessage)
    {
        $this->validationMessage = $validationMessage;

        return $this;
    }

    public function postField($key)
    {
        return $this->request->request->get($key);
    }

    public function field($key)
    {
        return $this->request->query->get($key);
    }

    public function postJsonField() {
        return json_decode($this->request->getContent());
    }

    public function jsonResponse($msg = '', $status = 200, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'payload' => $data
        ], $status);
    }

    public function jsonFailedResponse($msg = '') {
        return response()->json([
            'status' => 500,
            'message' => 'Terjadi Kesalahan '.$msg,
            'payload' => null
        ], 500);
    }

    public function uploadImage($field, $targetName = '', $disk = 'upload')
    {
        $file = \request()->file($field);
        return Storage::disk($disk)->put($targetName, File::get($file));
    }

    public function basicDataTables($object)
    {
        return DataTables::of($object)->addIndexColumn()->make(true);
    }

    public function convertToPdf($viewRender, $data = [])
    {
        $html = view($viewRender)->with($data);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }

    public function make_slug($text)
    {
        $divider = '-';
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return '';
        }

        return $text;
    }
    public function generateImageName($field = '')
    {
        $value = '';
        if (\request()->hasFile($field)) {
            $files     = \request()->file($field);
            $extension = $files->getClientOriginalExtension();
            $name      = $this->uuidGenerator();
            $value     = $name . '.' . $extension;
        }

        return $value;
    }

    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }
}
