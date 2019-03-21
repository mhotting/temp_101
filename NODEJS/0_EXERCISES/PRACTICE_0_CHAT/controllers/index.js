// Index controller

exports.getIndex = (req, res, next) => {
    res.render('index', { pageTitle: 'Accueil' });
};