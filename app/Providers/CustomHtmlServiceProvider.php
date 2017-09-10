<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormBuilder;

class CustomHtmlServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCustomFormComponents();
    }

    protected function registerCustomFormComponents()
    {
        FormBuilder::component('formGroup_text', 'components.formGroup.text', [
            'name',
            'label',
            'value',
            'attributes',
        ]);

        FormBuilder::component('formGroup_textarea', 'components.formGroup.textarea', [
            'name',
            'label',
            'value',
            'attributes',
        ]);

        FormBuilder::component('formGroup_submit', 'components.formGroup.submit', [
            'text' => 'Submit',
            'attributes',
        ]);

        FormBuilder::component('formGroup_checkbox', 'components.formGroup.checkbox', [
            'name',
            'label',
            'isChecked',
        ]);
    }
}
