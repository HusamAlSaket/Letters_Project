<?php
namespace App\Http\Controllers;

use App\Models\PhonemeActivity;
use Illuminate\Http\Request;

class PhonemeActivityController extends BaseController
{
    public function __construct()
    {
        $this->model = PhonemeActivity::class;
        $this->relations = [
            'phoneme:id,char',
        ];
        $this->view = 'phoneme_activity'; 
        $this->routeIndex = 'phoneme-activities.index'; 
        $this->routeShow = 'phoneme-activities.show';
        $this->routeUpdate = 'phoneme-activities.update';
        $this->routeDestroy = 'phoneme-activities.destroy';

        $this->compact = [
            'activities' => 'activity',
            'record' => 'record',
        ];
    }
}
