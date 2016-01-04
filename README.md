## JSON API PHP Library

This library implements the http://jsonapi.org/

#### TODO:
- [ ] More tests

### How to use

```php
$factory = new Json\Factory();
$documentBuilder = new Json\Document\Builder($factory);

$dataBuilder = $documentBuilder->getDataCollectionBuilder();

$documentLinksBuilder = $documentBuilder->getLinksCollectionBuilder();
$documentMetaBuilder = $documentBuilder->getMetaCollectionBuilder();
$documentIncludedBuilder = $documentBuilder->getIncludedCollectionBuilder();

// building the document data
$dataBuilder
    ->setId(1)
    ->setAttributes([
        'firstName' => 'Foo',
        'lastName' => 'Bar',
        'age' => 20,
        'active' => true
    ])
    ->setType('person');

// setting data relationships
$dataRelationshipsBuilder = $dataBuilder->getRelationshipsCollectionBuilder();
$dataRelationshipsBuilder->setName('friends');

$dataRelationshipsDataBuilder = $dataRelationshipsBuilder->getDataCollectionBuilder();
$dataRelationshipsDataBuilder
    ->setId(2)
    ->setType('person')
    ->setAttributes([
        'firstName' => 'Foo 1',
        'lastName' => 'Bar',
        'age' => 20,
        'active' => true
    ]);
$dataRelationshipsDataBuilder->addData()->addToParent(); // added data to relationships

$dataRelationshipsLinksBuilder = $dataRelationshipsBuilder->getLinksCollectionBuilder();
$dataRelationshipsLinksBuilder
    ->setName('self')
    ->setHref('http://www.facebook.com/2');
$dataRelationshipsLinksBuilder->addLink()->addToParent(); // added links to relationships

$dataRelationshipsMetaBuilder = $dataRelationshipsBuilder->getMetaCollectionBuilder();
$dataRelationshipsMetaBuilder
    ->setName('createdAt')
    ->setValue('19 July');
$dataRelationshipsMetaBuilder->addMeta()->addToParent(); // added meta to relationships

$dataRelationshipsBuilder->addRelationships()->addToParent(); // added relationships to data

$dataBuilder->addData()->addToParent(); // added to the document
// finished relationships and added to document

// building the document links
$documentLinksBuilder
    ->setName('self')
    ->setHref('http://www.facebook.com/me')
    ->addLink();
$documentLinksBuilder
    ->setName('related')
    ->setHref('http://www.facebook.com/1');
$documentLinksMetaBuilder = $documentLinksBuilder->getMetaCollectionBuilder();
$documentLinksMetaBuilder
    ->setName('self')
    ->setValue('yes')
    ->addMeta()
    ->addToParent();
$documentLinksBuilder->addLink()->addToParent(); // added links to the document
// finished building document links and added

// building the document meta
$documentMetaBuilder->setName('postsCount')->setValue(340)->addMeta();
$documentMetaBuilder->setName('friendsCount')->setValue(500)->addMeta();

$documentMetaBuilder->addToParent();
// finished document meta and added

echo $documentBuilder->getDocument()->getAsJson();
```

The above code will result the following:

```json
{
	"data": [{
		"type": "person",
		"id": 1,
		"attributes": {
			"firstName": "Foo",
			"lastName": "Bar",
			"age": 20,
			"active": true
		},
		"relationships": {
			"friends": {
				"links": {
					"self": "http:\/\/www.facebook.com\/2"
				},
				"data": [{
					"type": "person",
					"id": 2,
					"attributes": {
						"firstName": "Foo 1",
						"lastName": "Bar",
						"age": 20,
						"active": true
					}
				}],
				"meta": {
					"createdAt": "19 July"
				}
			}
		}
	}],
	"meta": {
		"friendsCount": 500,
		"postsCount": 340
	},
	"links": {
		"related": {
			"href": "http:\/\/www.facebook.com\/1",
			"meta": {
				"self": "yes"
			}
		},
		"self": "http:\/\/www.facebook.com\/me"
	}
}
```

Feel free to contribute, or report any issues.