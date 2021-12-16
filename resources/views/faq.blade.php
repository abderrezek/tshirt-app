<x-app-layout>
    <x-slot name="title">T-shirts - faq</x-slot>

    <h1 class="mt-5 mb-3 text-center">{{ Str::upper('faq') }}</h1>

    <div class="accordion accordion-flush" id="faq">
      <div class="accordion-item">
        <h2 class="accordion-header" id="one">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#oneAcc" aria-expanded="false" aria-controls="oneAcc">
            Comment commander ?
          </button>
        </h2>
        <div id="oneAcc" class="accordion-collapse collapse" aria-labelledby="one">
          <div class="accordion-body">Paragraphe. Cliquez ici pour ajouter votre propre texte. Cliquez sur « Modifier Texte » ou double-cliquez ici pour ajouter votre contenu et personnaliser les polices. Déplacez-moi où vous le souhaitez sur votre page. Utilisez cet espace pour décrire votre activité. Présentez votre entreprise, vos services et vos équipes.</div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="two">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#twoAcc" aria-expanded="false" aria-controls="twoAcc">
            Paiement et livraison
          </button>
        </h2>
        <div id="twoAcc" class="accordion-collapse collapse" aria-labelledby="two">
          <div class="accordion-body">Paragraphe. Cliquez ici pour ajouter votre propre texte. Cliquez sur « Modifier Texte » ou double-cliquez ici pour ajouter votre contenu et personnaliser les polices. Déplacez-moi où vous le souhaitez sur votre page. Utilisez cet espace pour décrire votre activité. Présentez votre entreprise, vos services et vos équipes.</div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="three">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#threeAcc" aria-expanded="false" aria-controls="threeAcc">
            Modes de paiements et sécurité
          </button>
        </h2>
        <div id="threeAcc" class="accordion-collapse collapse" aria-labelledby="three">
          <div class="accordion-body">Paragraphe. Cliquez ici pour ajouter votre propre texte. Cliquez sur « Modifier Texte » ou double-cliquez ici pour ajouter votre contenu et personnaliser les polices. Déplacez-moi où vous le souhaitez sur votre page. Utilisez cet espace pour décrire votre activité. Présentez votre entreprise, vos services et vos équipes.</div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="foor">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#foorAcc" aria-expanded="false" aria-controls="foorAcc">
            Échanges et remboursements
          </button>
        </h2>
        <div id="foorAcc" class="accordion-collapse collapse" aria-labelledby="foor">
          <div class="accordion-body">Paragraphe. Cliquez ici pour ajouter votre propre texte. Cliquez sur « Modifier Texte » ou double-cliquez ici pour ajouter votre contenu et personnaliser les polices. Déplacez-moi où vous le souhaitez sur votre page. Utilisez cet espace pour décrire votre activité. Présentez votre entreprise, vos services et vos équipes.</div>
        </div>
      </div>

    </div>

    <p class="fs-5 mx-4 mt-3 fw-bold">Merci d'avoir choisi notre boutique !</p>
</x-app-layout>