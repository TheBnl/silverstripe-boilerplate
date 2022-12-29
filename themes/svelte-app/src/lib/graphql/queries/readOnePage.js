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
  }
}
`;