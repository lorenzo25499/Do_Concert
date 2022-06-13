Vue.component('biglietto', {
    template: `
        <h6>Codice (7 cifre)<h6> 
        <input type= "text" name="codice" size="40" maxlength="40" autofocus required>
        <input type= "hidden" name="carrello" size="40" maxlength="40" value="0" autofocus required>
        <br>
        <h5>Inserisci i tuoi dati o quelli di un altro utente per regalargli dei biglietti<h5>
        <br>
        <h6>Nome<h6> 
        <input type= "text" name="nome" size="40" maxlength="40"  autofocus required>
        <br><br>
        <h6>Cognome<h6> 
        <input type= "text" name="cognome" size="40" maxlength="40"  autofocus required>
        <br><br>
        <div class="product">
            <div class="product-image">
                <img v-bind:src="image"/>
            </div>
            <div class="product-info">
                <h1>Prodotto in vendita: {{product}}</h1>
                Descrizione: {{description}}
                <ul>
                    <li v-for="x in details">{{x.text}}</li>
                </ul>
                <button type = "button"
                        v-on:click="addToCart()"
                        v-bind:disabled="!onSale"
                        v-bind:class="{disabledButton: !onSale}">
                    Aggiungi al carrello
                </button>
                <button name="acquistaButton"
                        v-bind:disabled="!onSale"
                        v-bind:class="{disabledButton: !onSale}">
                    Acquista
                </button>
            </div>
        </div>
    `,

    data: function() {
        return {
            product: 'Biglietto',
            description: 'Biglietto del concerto',
            selectedVariant: 0,
            details: [
                {text: 'Acquistabile unicamente nel nostro sito'},
                {text: 'Non rivendibile se non da personale autorizzato'}
            ],
            variants: [
                {onSale:true,
                image: './assets/biglietto.jpg'},

            ]
        };
    },

    methods: {
        addToCart: function() {
            this.$emit('add-to-cart');
        },
        updateProduct: function(i) {
            this.selectedVariant = i;
        }
    },
    computed: {
        onSale: function() {
            return this.variants[this.selectedVariant].onSale;
        },
        image: function() {
            return this.variants[this.selectedVariant].image;
        },
        cart: function() {
            return this.variants[this.selectedVariant].cart;
        }
    }
});

var app = new Vue({
    el: '#app',
    data: {
        cart: 0
    },
    methods: {
        updateCart: function() {
            this.cart +=1;
            document.myForm.carrello.value= this.cart;
        }
    }
});
