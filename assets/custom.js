/*
Talk.ready.then(function() {
    var me = new Talk.User({
        id: '123456',
        name: 'Alice',
        email: 'alice@example.com',
        photoUrl: 'https://www.lepoint.fr/images/2019/04/29/18633880lpw-18633909-article-zoo-beauval-animal-jpg_6166393_1250x625.jpg',
        welcomeMessage: 'Hey there! How are you? :-)',
        role: 'default'
    });
    window.talkSession = new Talk.Session({
        appId: 'tJCERajb',
        me: me
    });
    var other = new Talk.User({
        id: '654321',
        name: 'Sebastian',
        email: 'Sebastian@example.com',
        photoUrl: 'https://www.animaux-online.com/data/document/1/668.800.jpg',
        welcomeMessage: 'Hey, how can I help?',
        role: 'default'
    });

    var conversation = talkSession.getOrCreateConversation(Talk.oneOnOneId(me, other))
    conversation.setParticipant(me);
    conversation.setParticipant(other);

    var inbox = talkSession.createInbox({selected: conversation});
    inbox.mount(document.getElementById('talkjs-container'));
  });
  */