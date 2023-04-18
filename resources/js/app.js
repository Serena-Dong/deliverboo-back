import './bootstrap';
import '~resources/scss/app.scss';
import './delete-confirm.js';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// The checkout route
import checkout from '../../routes/checkout.js';
app.use('/checkout', checkout);
