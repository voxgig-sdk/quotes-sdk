import { QuotesEntityBase } from '../QuotesEntityBase';
import type { QuotesSDK } from '../QuotesSDK';
import type { Control } from '../types';
import type { Quote, QuoteLoadMatch, QuoteListMatch } from '../QuotesTypes';
declare class QuoteEntity extends QuotesEntityBase<Quote> {
    constructor(client: QuotesSDK, entopts: any);
    make(this: QuoteEntity): QuoteEntity;
    load(this: any, reqmatch?: QuoteLoadMatch, ctrl?: Control): Promise<QuoteEntity>;
    list(this: any, reqmatch?: QuoteListMatch, ctrl?: Control): Promise<QuoteEntity[]>;
}
export { QuoteEntity };
