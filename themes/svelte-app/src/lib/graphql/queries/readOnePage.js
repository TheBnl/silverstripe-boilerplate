// export default {
//   test: 'ja'
// };

import { gql } from 'graphql-request';

export default gql`
query readOnePage($link: String!) {
  readOnePage(link: $link) {
    id
    className
    title
    content
    urlSegment
    openGraphImage {
      id
    }
    banners {
      nodes {
       id 
      }
    }
    elementalArea {
      id
      elements {
        nodes {
          id
          className
          title
          showTitle
          ... on GalleryBlock {
            galleryItems {
              nodes {
                id
                image {
                  id
                }
              }
            }
          }
          ... on VideoBlock {
            videoURL
            embedCode
            videoPreview {
              id
            }
          }
        }
      }
    }
  }
}
`;