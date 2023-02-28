<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSystemSettingsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required_if:type,firstsection',
            'meta_description' => 'required_if:type,firstsection',
            'meta_keywords' => 'required_if:type,firstsection',
            'currency' => 'required_if:type,firstsection',
            'currency_symbol' => 'required_if:type,firstsection',
            'service_updates_page' => 'boolean|required_if:type,firstsection',
            'register_page' => 'boolean|required_if:type,firstsection',
            'directly_login' => 'boolean|required_if:type,firstsection',
            'autologin_after_registration' => 'boolean|required_if:type,firstsection',
            'forgot_password' => 'boolean|required_if:type,firstsection',
            'errorlogs_delete' => 'numeric|min:1|max:365|required_if:type,firstsection',
            'errorlogs_importance_level' => 'boolean|required_if:type,firstsection',
            'ticket_status' => 'boolean|required_if:type,firstsection',
            'max_open_ticket' => 'numeric|in:1,2,3,5,10,25,50,100,9999|required_if:type,firstsection',
            'terms_content' => 'nullable',
            'policy_content' => 'nullable',
            'javascript_embed_header' => 'nullable',
            'javascript_embed_footer' => 'nullable',
            'facebook_link' => 'required_if:type,secondsection',
            'twitter_link' => 'required_if:type,secondsection',
            'instagram_link' => 'required_if:type,secondsection',
            'youtube_link' => 'required_if:type,secondsection',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'title' => 'Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'currency' => 'Curreny',
            'currency_symbol' => 'Currency Symbol',
            'service_updates_page' => 'Service Updates Page',
            'register_page' => 'Register Page',
            'directly_login' => 'Default Homepage: Login Page',
            'autologin_after_registration' => 'Auto-login After Registration',
            'forgot_password' => 'Forgot Password Option',
            'errorlogs_delete' => 'Deletion Period of Error Logs',
            'errorlogs_importance_level' => 'Error Log Importance Level',
            'ticket_status' => 'Ticket Panel',
            'max_open_ticket' => 'Max. Open Ticket Per User',
            'terms_content' => 'Terms',
            'policy_content' => 'Policy',
            'javascript_embed_header' => 'Javascript Embed Header',
            'javascript_embed_footer' => 'Javascript Embed Footer',
            'facebook_link' => 'Facebook Link',
            'twitter_link' => 'Twitter Link',
            'instagram_link' => 'Instagram Link',
            'youtube_link' => 'Youtube Link',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required_if' => ':attribute field is required to change system settings.',
        ];
    }
}
