import { OwnerEntity } from './entity/OwnerEntity';
import { QuoteEntity } from './entity/QuoteEntity';
export type * from './QuotesTypes';
import { inspect } from 'node:util';
import type { Context, Feature } from './types';
import { config } from './Config';
import { QuotesEntityBase } from './QuotesEntityBase';
import { Utility } from './utility/Utility';
import { BaseFeature } from './feature/base/BaseFeature';
declare const stdutil: Utility;
declare class QuotesSDK {
    _mode: string;
    _options: any;
    _utility: Utility;
    _features: Feature[];
    _rootctx: Context;
    constructor(options?: any);
    options(): any;
    utility(): any;
    prepare(fetchargs?: any): Promise<any>;
    direct(fetchargs?: any): Promise<Error | {
        ok: boolean;
        status: number;
        headers: any;
        data: any;
        err?: undefined;
    } | {
        ok: boolean;
        err: any;
        status?: undefined;
        headers?: undefined;
        data?: undefined;
    }>;
    _rawRequest(fetchargs?: any): Promise<Error | {
        ok: boolean;
        status: number;
        headers: any;
        data: any;
        err?: undefined;
    } | {
        ok: boolean;
        err: any;
        status?: undefined;
        headers?: undefined;
        data?: undefined;
    }>;
    graphql(query: string, variables?: any, ctrl?: any): Promise<any>;
    Owner(entopts?: Record<string, any>): OwnerEntity;
    Quote(entopts?: Record<string, any>): QuoteEntity;
    static test(testoptsarg?: any, sdkoptsarg?: any): QuotesSDK;
    tester(testopts?: any, sdkopts?: any): QuotesSDK;
    toJSON(): {
        name: string;
    };
    toString(): string;
    [inspect.custom](): string;
}
declare const SDK: typeof QuotesSDK;
export { stdutil, config, BaseFeature, QuotesEntityBase, QuotesSDK, SDK, };
