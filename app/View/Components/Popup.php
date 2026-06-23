<?php

namespace App\View\Components;

use App\Settings\PopupSettings;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Popup extends Component
{
    public $showPopup = false;

    public $title;

    public $is_active;

    public $cookie_days;

    public $content;

    public $button_text;

    public $button_url;

    public $button_class;

    public $cookieName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $popupSettings = app(PopupSettings::class);

        $this->title = $popupSettings->title;
        $this->is_active = $popupSettings->is_active;
        $this->cookie_days = $popupSettings->cookie_days;
        $this->content = $popupSettings->content;
        $this->button_text = $popupSettings->button_text;
        $this->button_url = $popupSettings->button_url;
        $this->button_class = $popupSettings->button_class;
        $this->cookieName = 'popup-'.Str::slug($this->title);

        if ($this->is_active) {
            $cookieValue = request()->cookie($this->cookieName);

            $this->showPopup = ! $cookieValue;
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('frontend.components.popup');
    }
}
