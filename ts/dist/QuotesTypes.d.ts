export interface Owner {
    github?: string;
    name?: string;
}
export interface OwnerLoadMatch {
    github?: string;
    name?: string;
}
export interface Quote {
    author?: string;
    id?: number;
    quote?: string;
}
export interface QuoteLoadMatch {
    id: number;
    $action?: string;
    [action: string]: any;
}
export interface QuoteListMatch {
    author?: string;
    id?: number;
    quote?: string;
}
