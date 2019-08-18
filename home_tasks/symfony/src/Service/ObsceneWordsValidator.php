<?php


namespace App\Service;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ObsceneWordsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        $pattern = "/(блин)|(нахрен)/";
        $obsceneWords = "/(arse)|(ass)|(bampot)|(bastard)|(beaner)|(bitch)|(blowjob)|(bollocks)|(bollox)|(boner)|(butt)|
        (chesticle)|(chinc)|(chink)|(choad)|(clit)|(cock)|(coochie)|(coochy)|(cooter)|(cum)|(cunnie)|(cunt)|(dago)|(damn)|
        (deggo)|(dick)|(dike)|(dildo)|(dipshit)|(doochbag)|(dookie)|(douche)|(dyke)|(fag)|(fatass)|(fellatio)|(feltch)|
        (flamer)|(fuck)|(fudgepacker)|(gay)|(goddamn)|(gooch)|(gook)|(gringo)|(guido)|(handjob)|(heeb)|(hell)|(homo)|
        (honkey)|(humping)|(jackass)|(jagoff)|(jap)|(jerk)|(jigaboo)|(jizz)|(kike)|(kooch)|(kootch)|(kraut)|(kunt)|
        (kyke)|(lameass)|(lardass)|(lesbian)|(lesbo)|(lezzie)|(minge)|(muff)|(munging)|(negro)|(nigga)|(nigger)|(niglet)|
        (nutsack)|(paki)|(panooch)|(pecker)|(peckerhead)|(polesmoker)|(pollock)|(poon)|(porchmonkey)|(prick)|(punanny)|
        (punta)|(pussies)|(pussy)|(puto)|(queef)|(queer)|(renob)|(rimjob)|(ruski)|(schlong)|(scrote)|(shit)|(shiz)|(shiznit)|
        (skank)|(skeet)|(skullfuck)|(slut)|(smeg)|(snatch)|(spic)|(splooge)|(spook)|(suck)|(tard)|(testicle)|(tits)|(twat)|(va-j-j)|
        (vag)|(vagina)|(vajayjay)|(vjayjay)|(wank)|(whore)|(wop)/";

        if (!$constraint instanceof ObsceneWords) {
            throw new UnexpectedTypeException($constraint, ObsceneWords::class);
        }

        if (preg_match($obsceneWords, $value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
