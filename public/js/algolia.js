var client = algoliasearch('ZI9EJSEXQF', '18283e853f4222614107a9a7dd37c0dd');
var index = client.initIndex('products');

function newHitsSource(index, params) {
    return function doSearch(query, cb) {
    index
        .search(query, params)
        .then(function(res) {
        cb(res.hits, res);
        })
        .catch(function(err) {
        console.error(err);
        cb([]);
        });
    };
}

autocomplete('#search-input', { hint: false }, [
    {
        source: newHitsSource(index, { hitsPerPage: 10}),
        displayKey: 'name',
        templates: {
            suggestion: function(suggestion) {
            const markup = `
            <div class="algolia-result">
                <span>
                    <img src="${window.location.origin}/storage/${suggestion.image}" alt="img" class="algolia-thumb">
                    ${suggestion._highlightResult.title.value}
                </span>
                <span>${suggestion.price}</span>
            </div>
            <div class="details">
                <span>${suggestion._highlightResult.details.value}</span>
            </div>
            `;
            return markup;
            },
            empty: function(result){
                return 'Sorry we dont find any result for "'+ result.query + '"';
            }
        }
    }
]).on('autocomplete:selected', function(event, suggestion, dataset, context) {
    window.location.href = window.location.origin + '/shop/' + suggestion.slug;
});