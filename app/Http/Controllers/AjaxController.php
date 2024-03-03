<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function handleRequest($route)
    {
        // Implement logic for handling different AJAX routes
        $elements = "";
        $background = "";
        $autoTransitionLength = 0;
        $autoTransitionDestination = "";
        $redirectTo = "";
        $dialogue = null;

        switch ($route) {
            case 'start':
                $dialogue = [
                    'text' => "<span class='speaker'>???</span> The cabin looks to be in great shape. Nothing a little dusting won't fix.<br />I better get ready for the day.",
                    'options' => [
                        ['text' => 'Press P to prepare for the day', 'action' => 'mirror'],
                        ['text' => 'Quit Game', 'action' => 'quitGame'],
                    ],
                ];
                $elements = "
                <h1 class='animate-text amarante-regular' data-key-param='{\"p\":\"mirror\"}' style='left:250px; top: -90px;'>Press P to Survey your surroundings</h1>
                <x-dialogue :text=\"'" . $dialogue['text'] . "'\" :options=\"" . json_encode($dialogue['options']) . "\"></x-dialogue>
                ";
                /*
                if (Auth::check()) {
                    $elements = "
                        <h1 class='animate-text amarante-regular' data-key-param='{\"a\":\"survey-surroundings\"}' style='left:250px; top: -90px;'>Press C to Continue</h1>
                    ";
                }
                */
                $background = "./images/cabin-interior.webp";
                break;
            case 'survey-surroundings':
                $elements = "
                
                ";
                $background = "./images/world-overview.jpg";
            case 'cabin-after-survey':
                $elements = "
                    <h1 class='animate-text amarante-regular' data-key-param='{\"p\":\"use-mirror\"}' style='left:180px; bottom:160px; position:absolute;'>Press P to Prepare for the day</h1>
                ";
                $background = "/images/cabin-interior.webp";
            case 'mirror-used':
                $elements = "
                    <h1 class='animate-text amarante-regular' data-key-param='{\"l\":\"leave-cabin\"}' style='right:60px; position:absolute;'>Press L to Leave</h1>
                ";
                $background = "./images/cabin-interior.webp";
                break;
            case 'mirror-used':
                $elements = "
                    <h1 class='animate-text amarante-regular' data-key-param='{\"l\":\"leave-cabin\"}' style='right:60px; position:absolute;'>Press L to Leave</h1>
                ";
                $background = "./images/cabin-interior.webp";
                break;
            case 'leave-cabin':
                $elements = "";
                $background = "./images/off-to-fish.webp";
                $autoTransitionLength = 2;
                $autoTransitionDestination = "interior-fish";
                break;
            case 'appreciate-world':
                //TODO: survey - how do you see the world? place of opportunity, possibility, danger
                $elements = "";
                $background = "./images/off-to-fish.webp";
                break;
            case 'use-mirror':
                //TODO: survey - what do you see in self, what troubles you, what are your goals
                $elements = "";
                $background = "./images/off-to-fish.webp";
                break;                
            case 'interior-fish':
                $elements = "<h1 class='animate-text amarante-regular' data-key-param='{\"f\":\"attempt-fish\"}'>Press F to Fish</h1>";
                $background = "./images/fishing-view.webp";
                break;
            case 'attempt-fish':
                //run random fish attempt, include livewell storage $this->attemptFish($livewell)
                $redirectTo = route('fishing');
                break;
            default:
                // Handle unknown routes
                $elements = '<h1>Unknown Route</h1>';
                $background = "./images/pftf-cabin.gif";
        }

        return response()->json([
            'elements' => $elements,
            'background' => $background,
            'autoTransition' => $autoTransitionLength,
            'autoTransitionDestination' => $autoTransitionDestination,
            'redirectTo' => $redirectTo,
            'dialogue' => $dialogue,
        ]);
    }

    public function fishAttempt()
    {
        //generate random number between one and one thousand
        $randomNumber = mt_rand(1, 1000);
        //pull fish assigned range
        return $randomNumber;

    }

    public function storeFish($livewell)
    {
        if ($livewell <= 7) {
            //store fish only when space allows
            //assign fish space in livewell
        }
    }
}
