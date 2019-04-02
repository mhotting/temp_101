exports.getPosts = (req, res, next) => {
    res.json({
        posts: [{ title: 'First post', content: 'BLABLA' }]
    });
};