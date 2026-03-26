<?php

namespace App\Factories;

use App\Factories\PromotionDisplay;

class LimitedTimePromotionDisplay extends PromotionDisplay {

    public function displayPromotions(){
        $html = 
            <<<HTML
            <div class="row">
                <div style="background-color: #79a263; height: 50px; margin-bottom: 10px;text-align: center;">
                    <h3 style="color: white; line-height: 50px">Limited Time Promotions</h3>
                </div>                   
        HTML;
        if(count($this->promotions) > 0){
            foreach($this->promotions as $promotion){
                $html .= 
                <<<HTML
                    <div class="col-sm-4 col-xs-12">
                        <div class="panel panel-default text-center">

                        <div class="panel-body">
                            <h4>
                            <strong> $promotion->promotion </strong>
                            </h4>
                        </div>
                        <div class="panel-footer">
                            <button type="button" class="submit" data-toggle="modal" data-target="#exampleModalCenter"  data-id="$promotion->id" data-text="$promotion->promotion" style="width: 100%"> Remove Promotion </button>
                        </form>
                        </div>
                        </div>
                    </div>    
                HTML;
                
            }

        }
        else{
            $html .= <<<HTML
                <div class="col-xs-12">
                    <p>No limited time promotions added yet.</p>
                </div>
          HTML;
        }
        $html .=
        <<<HTML
        </div>
        HTML;
        return $html;
    }

    public function displayRestaurantPromotions() {
        $html = 
        <<<HTML
            <div class="row text-center bg-grey">
            <h3>Limited Time</h3>
        HTML;
        $i = 0;
        if(count($this->promotions) > 0){
            $html .= 
            <<<HTML
                <div id="limitedcarousel" class="carousel slide text-center" data-ride="carousel">
                <ol class="carousel-indicators">
            HTML;
                    for($i = 0; $i < count($this->promotions); $i++){
                        if($i == 0){
                            $html .= <<<HTML
                                <li data-target="#limitedcarousel" data-slide-to="0" class="active"></li>
                            HTML;
                        }
                        else{
                            $html .= <<<HTML
                                <li data-target="#limitedcarousel" data-slide-to="{{ $i }}"></li>
                            HTML;
                        }
                    }
                $html .= <<<HTML
                    </ol>
                    <div class="carousel-inner" role="listbox">
                HTML;
                $count = 0;
                foreach($this->promotions as $promotion){
                if($count == 0){
                    $html .= <<<HTML
                        <div class="item active">
                        <h4>$promotion->promotion</h4>
                        </div>
                    HTML;
                    $count++;
                }
                else{
                    $html .= <<<HTML
                        <div class="item">
                        <h4> $promotion->promotion</h4>
                        </div>
                    HTML;
                }
                }
                $html .= <<<HTML
                </div>
                    <a class="left carousel-control" href="#limitedcarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#limitedcarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    
                  
                </div>
                HTML;
        }
        $html .=
        <<<HTML
            </div>
        HTML;
        return $html;
    }

}