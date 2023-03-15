<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqUserSearch extends CoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Здесь
        // 1) Установленно приложение? = есть разрешение?
        // 2) Разрешен поиск? - perms.app = 'Users' perms.action = 'Search'
        // 2) Какие роли для поиска доступны - identities_perms.cnf = ['student', 'teacher']

        // При добалении
        // 1) Установленно приложение?
        // 2) Добавление разрешено? - perms.slug
        // 3) Какие роли доступны для создания - identities_perms.cnf

        // При изменении
        // 1) Установленно приложение?
        // 2) Изменение разрешено? - perms.slug
        // 3) Какие роли доступны для изменения - identities_perms.cnf

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

}
