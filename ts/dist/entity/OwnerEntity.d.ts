import { QuotesEntityBase } from '../QuotesEntityBase';
import type { QuotesSDK } from '../QuotesSDK';
import type { Control } from '../types';
import type { Owner, OwnerLoadMatch } from '../QuotesTypes';
declare class OwnerEntity extends QuotesEntityBase<Owner> {
    constructor(client: QuotesSDK, entopts: any);
    make(this: OwnerEntity): OwnerEntity;
    load(this: any, reqmatch?: OwnerLoadMatch, ctrl?: Control): Promise<OwnerEntity>;
}
export { OwnerEntity };
