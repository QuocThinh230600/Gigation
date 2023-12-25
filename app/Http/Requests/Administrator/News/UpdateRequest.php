<?php

namespace App\Http\Requests\Administrator\News;

use App\Repositories\News\NewsRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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

        $statuses = array();
        foreach (status() as $status) {
            $statuses[] = $status->id;
        }

        return [
            'title'                   => ['bail', 'required', 'unique:news_translations,title,' . $id . ',news_id,deleted_at,NULL'],
            'author'                  => ['required'],
            'date_start'              => ['required'],
            'time_start'              => ['required'],
            'position'                => ['bail', 'required', 'integer', 'gte:0'],
            'status'                  => ['bail', 'required', 'integer', Rule::in($statuses)],
            'featured'                => ['bail', 'required'],
            'template'                => ['bail', 'required', 'integer'],
            'viewed'                  => ['bail', 'required', 'integer', 'gte:0'],
            'intro'                   => ['required'],
            'image'                   => ['required'],
            'slug'                    => ['required'],
            'title_tag'               => ['required'],
            'category_id'             => ['bail', 'required', 'array', 'min:1', 'exists:categories,id'],
            'multi_images.*.image'    => ['required'],
            'multi_images.*.position' => ['bail', 'required', 'integer', 'gte:0'],
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
            'title'                   => attr('news.title'),
            'author'                  => attr('news.author'),
            'date_start'              => attr('news.date_start'),
            'time_start'              => attr('news.time_start'),
            'position'                => attr('news.position'),
            'status'                  => attr('news.status'),
            'featured'                => attr('news.featured'),
            'template'                => attr('news.template'),
            'viewed'                  => attr('news.viewed'),
            'intro'                   => attr('news.intro'),
            'image'                   => attr('news.image'),
            'category_id'             => attr('news.category'),
            'slug'                    => attr('seo.slug'),
            'title_tag'               => attr('seo.title_tag'),
            'multi_images.*.image'    => attr('images.source'),
            'multi_images.*.position' => attr('images.position'),
        ];
    }
}
