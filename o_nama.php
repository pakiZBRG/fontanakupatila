<?php include 'includes/header.php' ?>

<div class='container'>
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/carousel.php' ?>
    <div style='width: 75%; margin: 5rem auto; font-size: 1.1rem'>
        <h1 style='text-align: center;'>Malo reci o nama</h1>
        <p>Preduzeće <b>FONTANA d.o.o.</b> osnovano je 1990. godine u Valjevu sa svojim prvim maloprodajnim objektom specijalizovanim za prodaju vodovodnog i kanalizacionog materijala i prateće opreme za kupatila. Dugogodišnje iskustvo u ovoj oblasti i konstantno proširivanje prodajnog asortimana navelo nas je na otvaranje salona keramike koji u ponudi ima najraznovrsnije proizvode renomiranih domaćih i stranih proizvođača. Bavimo se uvozom i prodajom keramičkih i granitnih pločica, sanitarija, kupatilskog nameštaja, tuš kabina, kada, galanterije i ostale opreme koja Vam  je potrebna kada poželite da opremite kupatilo po najmodernijim trendovima.</p>
        <p>Pored toga, u našem asortimanu očekuje Vas kompletna ponuda elektromaterijala i veliki izbor rasvete za unutrašnje i spoljašnje osvetljenje. LED rasveta kao novi tip tehnologije koji pravi velike uštede električne energije sastavni je deo naše široke ponude.</p>
        <p>Poslujemo na dve lokacije:</p>
        <p>Salon keramike i opreme za kupatila u Dušanovoj br.68</p>
        <p>Prodavnica rasvete, vodovodnog i elektromaterijala u Dušanovoj br.56</p>

        <h2>Posaljite nam poruku</h2>
        <?php include 'includes/send-mail.inc.php' ?>
        <form method="POST" action="">
            <div class='form_control'>
                <label>Email</label>
                <input type='email' name='email' placeholder='neko@gmail.com'/>
            </div>
            <div class='form_control'>
                <label>Subjekt</label>
                <input type='text' name='subject' placeholder='Nesto kreativno'/>
            </div>
            <div class='form_control'>
                <label>Poruka</label>
                <textarea style='width: 40rem; resize:none; font-size: 1rem' name='message' rows='7'></textarea>
            </div>
            <input style='width: 20rem' type='submit' name='send' value='Posalji poruku' class='login_btn'/>
        </form>
    </div>

    
</div>

<?php include 'includes/footer.php' ?>