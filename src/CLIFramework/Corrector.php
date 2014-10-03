<?php
namespace CLIFramework;

class Corrector
{
    public $possibleTokens = array();

    public function __construct(array $possibleTokens = array())
    {
        $this->possibleTokens = $possibleTokens;
    }


    public function correct($input) {
        // no shortest distance found, yet
        $shortest = -1;

        // loop through words to find the closest
        foreach ($this->possibleTokens as $word) {

            // calculate the distance between the input word,
            // and the current word
            $lev = levenshtein($input, $word);

            // check for an exact match
            if ($lev == 0) {

                // closest word is this one (exact match)
                $closest = $word;
                $shortest = 0;

                // break out of the loop; we've found an exact match
                break;
            }

            // if this distance is less than the next found shortest
            // distance, OR if a next shortest word has not yet been found
            if ($lev <= $shortest || $shortest < 0) {
                // set the closest match, and shortest distance
                $closest  = $word;
                $shortest = $lev;
            }
        }
        if ($shortest == 0) {
            return array(0, $closest);
        }
        return array($shortest, $closest);
    }
}



