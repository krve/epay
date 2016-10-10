<?php

namespace Epay\Error;

class ErrorParser
{
    protected static $errors = [
        '-10006' => [
            'default' => 'Interrupted',
        ],
        '-5604' => [
            'default' => 'Gebyret kan ikke udregnes for den anvendte korttype.',
        ],
        '-5603' => [
            'default' => 'Butikken tillader ikke den anvendte korttype/betalingskort',
        ],
        '-5602' => [
            'default' => 'Invalid currency code.',
        ],
        '-5601' => [
            'default' => 'Gebyret kan ikke udregnes for den anvendte korttype.',
        ],
        '-5600' => [
            'default' => 'The card number is not set correctly - invalid prefix (must be 6 characters).',
        ],
        '-5514' => [
            'default' => 'Kundens session er enten udløbet, eller også er betalingen ikke startet korrekt.',
        ],
        '-5511' => [
            'default' => 'An error occured! Start over with your payment.',
        ],
        '-5509' => [
            'default' => 'Du får fejlen Not valid data, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi ePay ikke kan finde dataene til transaktionen. Denne fejl opstår, fordi brugeren/kunden har været inaktivt i over 20 minutter!'
        ],
        '-5508' => [
            'default' => 'Du får fejlen No valid domains i created for the company, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi du ikke har oprettet et domænet til jeres konto i betalingssystemet. I din administration til betalingssystemet under Instillinger og Betalingssystemet, kan du se det/de domæne(r), som er tilknyttet jeres konto.'
        ],
        '-5507' => [
            'default' => 'Du får fejlen URL not allowed for relaying, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi det domæne som du åbner betalingsvinduet fra, ikke er oprettet i betalingssystemet. I din administration til betalingssystemet under Instillinger og Betalingssystemet, kan du se det/de domæne(r), som er tilknyttet jeres konto.'
        ],
        '-5506' => [
            'default' => 'Du får fejlen Invalid merchantnumber, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi det indløsningsnummer / merchantnumber du anvender ikke er oprettet i Betalingssystemet! Tjek derfor om du anvender det rigtige merchantnumber. I din administration til betalingssystemet under Instillinger og Betalingssystemet, kan du se de merchants, som er tilknyttet jeres konto.'
        ],
        '-5505' => [
            'default' => 'Du får fejlen No cardtypes defined, når du prøver at åbne Standard Betalingsvinduet. Det er fordi, der ikke er sat nogle betalingskort op på jeres konto i betalingssystemet.'
        ],
        '-5504' => [
            'default' => 'Du får fejlen Invalid currencycode, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi du anvender en ugyldig currencycode. Du kan fra din administration til betalingssystemet under Support og Valutakoder se listen over valutakoder, der kan anvendes.'
        ],
        '-5503' => [
            'default' => 'De data som du sender til betalingsvinduet er ikke korrekte! Du får en beskrivelse af hvilke data, som det er, der ikke er angivet korrekte.'
        ],
        '-5502' => [
            'default' => 'Du får fejlen Invalid company, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi du ikke har aktiveret betalingsvinduet endnu. Du skal aktivere betalingsvinduet fra din administration til betalingssystemet under Instillinger og Betalingsvinduet.'
        ],
        '-5501' => [
            'default' => 'Du får fejlen Window not activated, når du prøver at åbne Standard Betalingsvinduet. Du får denne fejl, fordi du ikke har aktiveret betalingsvinduet endnu. Du skal aktivere betalingsvinduet fra din administration til betalingssystemet under Instillinger og Betalingsvinduet.'
        ],
        '-2003' => [
            'default' => 'Rejected - Kortudstederens land / region matcher ikke med det land betalingen kommer fra.',
        ],
        '-2002' => [
            'default' => 'Rejected - Ikke sikre betalinger fra land / region accepteres ikke.',
        ],
        '-2001' => [
            'default' => 'Rejected - Betalinger fra land / region accepteres ikke.',
        ],
        '-2000' => [
            'default' => 'Rejected - Betalinger fra din IP Addresse accepteres ikke.',
        ],
        '-1602' => [
            'defaukt' => 'PBS test-gateway er desværre nede i øjeblikket, prøv igen senere.'
        ],
        '-1601' => [
            'defaukt' => 'Svar sendt til betalingssystemet var forventet at være fra en netbank, men er invalid. Invalide data var posted.'
        ],
        '-1600' => [
            'defaukt' => 'Session fra netbank er allerede brugt. Samme session kan ikke benyttes igen.'
        ],
        '-1303' => [
            'defaukt' => 'Rejected - Betalingen kunne ikke hæves - afvist af EWIRE.'
        ],
        '-1302' => [
            'defaukt' => 'Rejected - Fejl i ewire MD5 data. Kontroller at MD5 data er opsat i både EWIRE og ePay.'
        ],
        '-1301' => [
            'default' => 'Rejected - EWIRE forretningsnummer var ikke fundet - Kontroller at EWIRE forretningsnummeret er opsat i ePay.'
        ],
        '-1300' => [
            'default' => 'Du forsøger at betale med en betalingsform, som forretningen ikke accepterer. Prøv en anden betalingsform eller kontakt forretningen.'
        ],
        '-1200' => [
            'default' => 'Ukendt valutakode. Du kan kun benytte de valutakoder, som du kan se under menupunktet Support og Valutakoder i administrationen.'
        ],
        '-1100' => [
            'default' => 'Invalid data modtaget hos betalingssystemet. Du skal huske at sende beløbet i mindste enhed / minor units (DKK skal fx. angives i øre), og må ikke bruge komma eller punktum (separatortegn). Derudover skal du være opmærksom på at fremsende felterne cardno, expmonth og expyear, der er nødvendige for at kunne gennemføre en korttransaktion.'
        ],
        '-1023' => [
            'default' => 'Transaktionen er allerede hævet'
        ],
        '-1022' => [
            'default' => 'Transaktionen er afvist, da forretningen har valgt at blokere alle transaktioner, der matcher kortnummeret.'
        ],
        '-1021' => [
            'default' => 'De kan på en transaktion max udføres en operation hvert 15 minut. Vent 15 minutter og prøv igen.'
        ],
        '-1020' => [
            'default' => 'The transaction is deleted'
        ],
        '-1019' => [
            'default' => 'Wrong password used for web access!'
        ],
        '-1018' => [
            'default' => 'Forkert test-kort benyttet! Du finder de gyldige testoplysninger under menuen Support - Test Oplysninger, når du har logget ind i administrationen til betalingssystemet.'
        ],
        '-1017' => [
            'default' => 'Ingen adgang til PCI nødvendig funktion!'
        ],
        '-1016' => [
            'default' => 'Der er driftsforstyrelser hos indløseren. Dette er en offline procedure. Vent venligst et kort øjeblik, og prøv igen.'
        ],
        '-1015' => [
            'default' => 'Valuta kode var ikke fundet. Du skal her undersøg hvilke valuta koder du kan gennemføre betalinger med.'
        ],
        '-1014' => [
            'default' => 'Rejected - korttypen var ikke valid for 3D secure. Butikken har valgt ikke at acceptere ikke 3D secure betalinger!'
        ],
        '-1012' => [
            'default' => 'Rejected - Cannot renew this card type.'
        ],
        '-1011' => [
            'default' => 'MD5 stempling var ikke valid.'
        ],
        '-1010' => [
            'default' => 'Korttype var ikke fundet i den angivne liste af forud definerede korttyper (feltet cardtype). Hvis du ønsker at kunne tage imod denne type kort skal du tilføje korttypen til denne liste.'
        ],
        '-1009' => [
            'default' => 'Abonnementsbetaling var ikke fundet.'
        ],
        '-1008' => [
            'default' => 'The transaction could not be found.'
        ],
        '-1007' => [
            'default' => 'Der er afvigelser i beløb hævet / til rådighed. Undersøg beløbet der hæves / krediteres mod det beløb der er autoriseret / hævet. Bemærk hvis der er tale om en Euroline transaktion, og transaktionen er hævet, kan den først krediteres den efterfølgende dag.'
        ],
        '-1006' => [
            'default' => 'Product not available.'
        ],
        '-1005' => [
            'default' => 'Driftsforstyrrelser - prøv igen senere.'
        ],
        '-1004' => [
            'default' => 'Error code not found.'
        ],
        '-1003' => [
            'default' => 'Ikke åbent for ipadresse for remote interface.'
        ],
        '-1002' => [
            'default' => 'The merchant number does not exists.'
        ],
        '-1001' => [
            'default' => 'The order number already exists.'
        ],
        '-1000' => [
            'default' => 'Kommunikations forstyrrelser til PBS.'
        ],
        '-23' => [
            'default' => 'PBS test gateway unavailable.'
        ],
        '-4' => [
            'default' => 'Kommunikations forstyrrelser til PBS.'
        ],
        '-3' => [
            'default' => 'Kommunikations forstyrrelser til PBS.'
        ],
        '4000' => [
            'default' => 'eDankort / PBS 3D secure / Banker - betaling afbrudt af bruger'
        ],
        '4001' => [
            'default' => 'SOLO - The user cancelled the payment'
        ],
        '4002' => [
            'default' => 'SOLO - The user was rejected'
        ],
        '4003' => [
            'default' => 'SOLO - fejl i MAC (MD5)'
        ],
        '4100' => [
            'default' => 'Rejected - No answer'
        ],
        '4101' => [
            'default' => 'Rejected - Ring til kortudstederen'
        ],
        '4102' => [
            'default' => 'Rejected - Ring til kortudstederen og behold kortet (svindel)'
        ],
        '4103' => [
            'default' => 'Betalingen blev afvist. Det kan eventuelt skyldes du har tastet forkerte oplysninger. Prøv igen, og hvis fejlen bliver ved med at opstå skal du kontakte forretningen.'
        ],
        '4104' => [
            'default' => 'Rejected - Systemerror - No answer'
        ],
        '4105' => [
            'default' => 'Rejected - Unknown Error'
        ],
        '4106' => [
            'default' => 'Rejected - Kort ikke godkendt af VISA / MasterCard / JCB (3D Secure). Du skal prøve igen.'
        ],
        '4107' => [
            'default' => 'Rejected - Kan ikke frigive Euroline (SEB) betalinger (understøttes ikke)'
        ],
        '4108' => [
            'default' => 'Rejected - Kan ikke forny Euroline (SEB) betalinger (understøttes ikke)'
        ],
        '4109' => [
            'default' => 'Rejected - Kort kunne ikke blive godkendt af 3D secure'
        ],
        '4110' => [
            'default' => 'Rejected - Der skete en fejl under godkendelse af 3D secure'
        ],
        '4111' => [
            'default' => 'Rejected - Kortet kunne ikke findes hos 3D secure'
        ],
        '10004' => [
            'default' => 'The payment through Danske Bank was interrupted.'
        ],
        '10005' => [
            'default' => 'The payment through Danske Bank was interrupted.'
        ],
    ];

    /**
     * Get the error message based on the code
     *
     * @param $code
     *
     * @return string
     * @throws \Epay\Error\ErrorCodeNotFound
     */
    public static function getMessage($code)
    {
        if (! in_array($code, array_keys(static::$errors))) {
            throw new ErrorCodeNotFound;
        }

        return $code . ': ' . static::$errors[$code]['default'];
    }
}
