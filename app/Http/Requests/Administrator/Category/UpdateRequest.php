<?php

namespace App\Http\Requests\Administrator\Category;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryTranslationRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $category;

    protected $categoryTranslation;

    /**
     * UpdateRequest constructor.
     * @param CategoryRepository $category
     * @param CategoryTranslationRepository $categoryTranslation
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(CategoryRepository $category,
                                CategoryTranslationRepository $categoryTranslation)
    {
        parent::__construct();
        $this->category            = $category;
        $this->categoryTranslation = $categoryTranslation;
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
        $category_id = $this->category->getIdByUuid($this->route('category'));

        return [
            'name'      => ['bail', 'required', 'unique:categories_translations,name,' . $category_id . ',category_id,deleted_at,NULL'],
            'parent_id' => ['bail', 'required', 'exists:categories,id'],
            'position'  => ['bail', 'required', 'integer', 'gte:0'],
            'slug'      => ['required'],
            'title_tag' => ['required']
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
            'name'      => attr('category.name'),
            'parent_id' => attr('category.parent'),
            'position'  => attr('category.position'),
            'slug'      => attr('seo.slug'),
            'title_tag' => attr('seo.title_tag'),
        ];
    }
}
