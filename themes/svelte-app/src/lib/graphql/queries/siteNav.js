import { gql } from 'graphql-request';

export default gql`
query siteNav {
  readPages(filter:{showInMenus:{eq:true},parentID:{eq:0}}) {
    nodes {
     	id 
      menuTitle
      urlSegment
      link 
    }
  }
}
`