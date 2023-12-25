<?php

namespace App\Http\Requests\Administrator\Page;

use App\Repositories\Page\PageRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $page;

    /**
     * UpdateRequest constructor.
     * @param PageRepository $page
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(PageRepository $page)
    {
        parent::__construct();
        $this->page = $page;
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
        $id = $this->page->getIdByUuid($this->route('page'));

        return [
            'name' => ['bail', 'required', 'unique:pages_translations,name,' . $id . ',page_id,deleted_at,NULL'],
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
            'name' => attr('page.name')
        ];
    }
}
