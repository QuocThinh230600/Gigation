<?php

namespace App\Http\Requests\Administrator\News;

use App\Repositories\News\NewsRepository;
use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest
{
    protected $news;

    /**
     * UpdateRequest constructor.
     * @param NewsRepository $news
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(NewsRepository $news)
    {
        parent::__construct();
        $this->news = $news;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function rules()
    {
        $id = $this->news->getIdByUuid($this->route('news'));

        return [
            'title'     => ['bail', 'required', 'unique:news_translations,title,' . $id . ',news_id,deleted_at,NULL'],
            'author'    => ['required'],
            'intro'     => ['required'],
            'image'     => ['required'],
            'slug'      => ['required'],
            'title_tag' => ['required'],
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function messages()
    {
        return [
            //
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function attributes()
    {
        return [
            'title'     => attr('news.title'),
            'author'    => attr('news.author'),
            'intro'     => attr('news.intro'),
            'image'     => attr('news.image'),
            'slug'      => attr('seo.slug'),
            'title_tag' => attr('seo.title_tag'),
        ];
    }
}
