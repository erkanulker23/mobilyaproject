# FAQ Module

## Example Queries

```gql
{
    faq(slug: "slug-for-search"){
        id
        name
        description
        items{
            title
            description
            properties
            pivot{
                order_column
            }
        }
    }
}
```
