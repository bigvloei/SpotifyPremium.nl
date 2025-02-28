<?php
$pageTitle = "Algemene Voorwaarden - SpotifyPremium";
include 'header.php';
?>

<main class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 mb-3">Algemene Voorwaarden</h1>
        <div class="legal-badge mb-4 bg-gradient-secondary text-white py-2 rounded-pill shadow-sm">
            📜 Laatst bijgewerkt: 3 februari 2025 | 🔐 Geldig voor alle aankopen
        </div>
    </div>

    <!-- Gebruik een Bootstrap Accordion voor collapsible secties -->
    <div class="accordion modern-accordion" id="termsAccordion">
        <!-- Introductie -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingIntro">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIntro" aria-expanded="true" aria-controls="collapseIntro">
                    <i class="fas fa-book-open me-2 text-primary"></i>Introductie
                </button>
            </h2>
            <div id="collapseIntro" class="accordion-collapse collapse show" aria-labelledby="headingIntro" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p>Welkom bij SpotifyPremium.nl (<a href="https://SpotifyPremium.nl">https://SpotifyPremium.nl</a>). Deze voorwaarden zijn van toepassing op alle diensten en aankopen.</p>
                </div>
            </div>
        </div>
        <!-- Intellectuele Eigendomsrechten -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEigendom">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEigendom" aria-expanded="false" aria-controls="collapseEigendom">
                    <i class="fas fa-copyright me-2 text-info"></i>Intellectuele Eigendomsrechten
                </button>
            </h2>
            <div id="collapseEigendom" class="accordion-collapse collapse" aria-labelledby="headingEigendom" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p>Alle content op deze website is beschermd onder Nederlands auteursrecht. Wij verlenen een beperkte licentie voor persoonlijk gebruik.</p>
                </div>
            </div>
        </div>
        <!-- Gebruiksbeperkingen -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingBeperkingen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBeperkingen" aria-expanded="false" aria-controls="collapseBeperkingen">
                    <i class="fas fa-ban me-2 text-danger"></i>Gebruiksbeperkingen
                </button>
            </h2>
            <div id="collapseBeperkingen" class="accordion-collapse collapse" aria-labelledby="headingBeperkingen" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                        <li>Website-materiaal herpubliceren</li>
                        <li>Commercieel gebruik van content</li>
                        <li>Publieke weergave of uitvoering van materiaal</li>
                        <li>Schadelijk gedrag op de site</li>
                        <li>Toegang voor andere gebruikers belemmeren</li>
                        <li>Wettelijk verboden activiteiten</li>
                        <li>Data mining of harvesting</li>
                        <li>Ongeautoriseerde marketingactiviteiten</li>
                    </ul>
                    <p>Toegang tot bepaalde delen van de website kan worden beperkt.</p>
                </div>
            </div>
        </div>
        <!-- Gebruikerscontent -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingGebruikers">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGebruikers" aria-expanded="false" aria-controls="collapseGebruikers">
                    <i class="fas fa-user-edit me-2 text-warning"></i>Gebruikerscontent
                </button>
            </h2>
            <div id="collapseGebruikers" class="accordion-collapse collapse" aria-labelledby="headingGebruikers" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p>U bent zelf verantwoordelijk voor uw eigen handelen en de content die u plaatst.</p>
                </div>
            </div>
        </div>
        <!-- Privacy -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingPrivacy">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrivacy" aria-expanded="false" aria-controls="collapsePrivacy">
                    <i class="fas fa-lock me-2 text-success"></i>Privacy
                </button>
            </h2>
            <div id="collapsePrivacy" class="accordion-collapse collapse" aria-labelledby="headingPrivacy" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p>Ons privacybeleid is beschikbaar via <a href="/privacybeleid">https://SpotifyPremium.nl/privacybeleid</a></p>
                </div>
            </div>
        </div>
        <!-- Restitutiebeleid -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingRestitutie">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRestitutie" aria-expanded="false" aria-controls="collapseRestitutie">
                    <i class="fas fa-euro-sign me-2 text-danger"></i>Restitutiebeleid
                </button>
            </h2>
            <div id="collapseRestitutie" class="accordion-collapse collapse" aria-labelledby="headingRestitutie" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p class="text-danger"><strong>Alle aankopen zijn definitief.</strong> Omdat het een licentiesleutel bevat, is restitutie NIET mogelijk na activatie.</p>
                </div>
            </div>
        </div>
        <!-- Garanties -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingGaranties">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGaranties" aria-expanded="false" aria-controls="collapseGaranties">
                    <i class="fas fa-shield-alt me-2 text-success"></i>Garanties
                </button>
            </h2>
            <div id="collapseGaranties" class="accordion-collapse collapse" aria-labelledby="headingGaranties" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p>U kunt onbeperkt gebruik maken van onze service zolang wij deze leveren. We werken al 8 jaar samen met een betrouwbare partner.</p>
                </div>
            </div>
        </div>
        <!-- Juridische bepalingen -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingJuridisch">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJuridisch" aria-expanded="false" aria-controls="collapseJuridisch">
                    <i class="fas fa-gavel me-2 text-secondary"></i>Juridische Bepalingen
                </button>
            </h2>
            <div id="collapseJuridisch" class="accordion-collapse collapse" aria-labelledby="headingJuridisch" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                        <li><strong>Vrijwaring:</strong> U vrijwaart ons voor alle claims voortkomend uit schending van deze voorwaarden.</li>
                        <li><strong>Geldigheid:</strong> Nietigverklaring van een clausule tast overige voorwaarden niet aan.</li>
                        <li><strong>Toepasselijk recht:</strong> Nederlands recht, geschillen eerst via overleg oplossen.</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Wijzigingen -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingWijzigingen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWijzigingen" aria-expanded="false" aria-controls="collapseWijzigingen">
                    <i class="fas fa-pencil-alt me-2 text-muted"></i>Wijzigingen
                </button>
            </h2>
            <div id="collapseWijzigingen" class="accordion-collapse collapse" aria-labelledby="headingWijzigingen" data-bs-parent="#termsAccordion">
                <div class="accordion-body">
                    <p>Wij behouden het recht deze voorwaarden te allen tijde aan te passen. Door voortgezet gebruik accepteert u de gewijzigde voorwaarden.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
