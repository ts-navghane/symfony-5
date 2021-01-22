const $container = $('.js-vote-arrows');
$container.find('a').on('click', function (e) {
    e.preventDefault();
    const $link = $(e.currentTarget);

    $.ajax({
        url: '/comment/1/vote/' + $link.data('direction'),
        method: 'POST'
    }).then(function (data) {
        $container.find('.js-vote-total').text(data.votes);
    });
});
