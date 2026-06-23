# Chat Module

## Installation

Add tese mutations to your GraphQL Schema

```gql
createComment(
    commentableId: ID!
    commentableType: String!
    comment: String!
    parentId: ID
): Comment! @validator @guard @can(ability: "create")

deleteComment(
    id: ID!
): Comment! @validator @guard @can(ability: "delete", query: true)

editComment(
    id: ID!
    comment: String!
): Comment! @validator @guard @can(ability: "update", query: true)
```

## Prepare your model

Add CanComment trait into your model: (User etc.)

```diff
+ use Modules\Comment\Traits\CanComment;
class User extends Model{
+    use CanComment;
}
```

Then add HasComments trait into your other model: (Video, Post etc.)

```diff
+ use Modules\Comment\Traits\HasComments;
class Post extends Model{
+    use HasComments;
}
```

## Usage

``` php
$user = App\User::first();
$product = App\Product::first();

// $user->comment(Commentable $model, $comment = '', $parent = null);
$user->comment($product, 'Lorem ipsum ..');

// approve it -- if the user model `canCommentWithoutApprove()` or you don't use `mustBeApproved()`, it is not necessary
$product->comments[0]->approve();

// get total comments count -- it calculates approved comments count.
$product->totalCommentsCount();
```

## Filament

## Updating Module

## Building Resources

## TODO
