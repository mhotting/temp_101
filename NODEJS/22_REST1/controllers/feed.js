exports.getPosts = (req, res, next) => {
    res.status(200).json({
        posts: [{ title: 'First post', content: 'BLABLA' }]
    });
};

exports.createPost = (req, res, next) => {
    const title = req.body.title;
    const content = req.body.content;
    // Create post in DB
    console.log(title);
    res.status(201).json({
        message: 'Post created Successfully!',
        post: { id: new Date().toISOString(), title: title, content: content }
    });
};