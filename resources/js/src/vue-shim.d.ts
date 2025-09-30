declare module '*.vue' {
  import type { DefineComponent } from 'vue'
  const component: DefineComponent<{}, {}, any>
  export default component
}

declare module 'moment' {
  interface Moment {
    format(format?: string): string;
  }
  
  function moment(inp?: any, format?: string): Moment;
  export = moment;
}

