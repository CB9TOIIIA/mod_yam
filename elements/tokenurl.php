<?php
defined('_JEXEC') or die();
jimport('joomla.form.formfield');

class JFormFieldTokenUrl extends JFormField
{
    public $type = 'TokenUrl';

    protected function getInput()
    {
        $params = $this->form->getValue('params');
        $app_id = isset($params->app_id) ? (string)$params->app_id : '';

        if(empty($app_id))
        {
            $html = 'Создайте приложение, вставтье его ID в поле "ID приложения" и сохраните настройки.';
        }
        else
        {
            $html = '<a target="_blank" href="https://oauth.yandex.ru/authorize?response_type=token&client_id='.$app_id.'">https://oauth.yandex.ru/authorize?response_type=token&client_id='.$app_id.'</a>';
        }

        return $html;
    }
}
