

import Path from 'node:path'
import * as Fs from 'node:fs'

import { test, describe, afterEach } from 'node:test'
import assert from 'node:assert'
import { createLiveTransport } from '../../live-runner'
import { runLiveEntity } from '../../live-entity'


import { QuotesSDK, BaseFeature, stdutil } from '../../..'

import {
  envOverride,
  liveClientOptions,
  liveDelay,
  loadEnvLocal,
  makeCtrl,
  makeMatch,
  makeReqdata,
  makeStepData,
  makeValid,
  maybeSkipControl,
} from '../../utility'


// AFTER the imports on purpose: TypeScript hoists `import` above any
// statement in the emitted CommonJS, so a loader placed above them would
// run only after every imported module had already been evaluated - and
// anything reading process.env at module scope would miss these values.
loadEnvLocal(__dirname + '/../../../.env.local')


describe('OwnerEntity', async () => {

  // Per-test live pacing. Delay is read from sdk-test-control.json's
  // `test.live.delayMs`; only sleeps when QUOTES_TEST_LIVE=TRUE.
  afterEach(liveDelay('QUOTES_TEST_LIVE'))

  test('instance', async () => {
    const testsdk = QuotesSDK.test()
    const ent = testsdk.Owner()
    assert(null != ent)
  })


  test('basic', async (t) => {

    const live = 'TRUE' === process.env.QUOTES_TEST_LIVE
    for (const op of ['load']) {
      if (!live && maybeSkipControl(t, 'entityOp', 'owner.' + op, live)) return
    }

    
    const setup = basicSetup()
    if (setup.live) {
      return runLiveEntity(setup, {"active":true,"alias":{"field":{}},"fields":[{"active":true,"name":"github","req":false,"short":"GitHub profile URL","type":"`$STRING`","index$":0},{"active":true,"name":"name","req":false,"short":"Name of the API owner","type":"`$STRING`","index$":1}],"name":"owner","op":{"load":{"input":"data","name":"load","points":[{"active":true,"args":{},"contract":{"id":"GET /owner","json":"{\"operationId\":\"getOwnerInfo\",\"parameters\":[],\"protocol\":\"http\",\"responses\":{\"200\":{\"content\":{\"application/json\":{\"schema\":{\"example\":{\"github\":\"https://github.com/subhamkumarsinha\",\"name\":\"Subham Kumar Sinha\"},\"properties\":{\"github\":{\"description\":\"GitHub profile URL\",\"type\":\"string\"},\"name\":{\"description\":\"Name of the API owner\",\"type\":\"string\"}},\"type\":\"object\"}}},\"description\":\"Successful response with owner information\"}},\"securitySource\":\"unspecified\"}","source":"openapi3","version":1},"kind":"http","method":"GET","orig":"/owner","segments":[{"lit":"owner"}],"select":{},"transform":{"req":"`reqdata`","res":"`body`"},"index$":0}],"key$":"load"}},"relations":{"ancestors":[]},"key$":"owner","name__orig":"owner","Name":"Owner","name_":"owner","name-":"owner","NAME":"OWNER","index$":0}, {"active":true,"entity":"owner","key$":"BasicOwnerFlow","kind":"basic","name":"BasicOwnerFlow","param":{},"step":[{"active":true,"data":{},"input":{"ref":"owner_ref01","srcdatavar":"owner_ref01_data","suffix":"_dt0"},"match":{},"op":"load","spec":[],"valid":[{"apply":"TextFieldMark","def":{"mark":"Mark01-owner_ref01"}}],"index$":0}]}, 'Owner')
    }
    const client = setup.client
    const struct = setup.struct

    const isempty = struct.isempty
    const select = struct.select

    let owner_ref01_data = Object.values(setup.data.existing.owner)[0] as any

    // LOAD
    const owner_ref01_ent = client.Owner()
    const owner_ref01_match_dt0: any = {}
    const owner_ref01_data_dt0 = (await owner_ref01_ent.load(owner_ref01_match_dt0)).data()
    assert(null != owner_ref01_data_dt0)


  })
})



function basicSetup(extra?: any) {
  // TODO: fix test def options
  const options: any = {} // null

  // TODO: needs test utility to resolve path
  const entityDataFile =
    Path.resolve(__dirname, 
      '../../../../.sdk/test/entity/owner/OwnerTestData.json')

  // TODO: file ready util needed?
  const entityDataSource = Fs.readFileSync(entityDataFile).toString('utf8')

  // TODO: need a xlang JSON parse utility in voxgig/struct with better error msgs
  const entityData = JSON.parse(entityDataSource)

  options.entity = entityData.existing

  let client = QuotesSDK.test(options, extra)
  const struct = client.utility().struct
  const merge = struct.merge
  const transform = struct.transform

  let idmap = transform(
    ['owner01','owner02','owner03'],
    {
      '`$PACK`': ['', {
        '`$KEY`': '`$COPY`',
        '`$VAL`': ['`$FORMAT`', 'upper', '`$COPY`']
      }]
    })

  const env = envOverride({
    'QUOTES_TEST_OWNER_ENTID': idmap,
    'QUOTES_TEST_LIVE': 'FALSE',
    'QUOTES_TEST_EXPLAIN': 'FALSE',
  })

  idmap = env['QUOTES_TEST_OWNER_ENTID']

  const live = 'TRUE' === env.QUOTES_TEST_LIVE

  const transport = createLiveTransport()
  if (live) {
    const rawIds = process.env['QUOTES_TEST_OWNER_ENTID']
    idmap = rawIds && rawIds.trim() ? JSON.parse(rawIds) : {}
    if (!idmap || Array.isArray(idmap) || typeof idmap !== 'object') {
      throw new Error('Live ENTID must be a JSON object')
    }
    client = new QuotesSDK(merge([
      // FIRST, so the generated fields below win: sdk-test-control.json's
      // test.client.options adds to the live client, it does not redirect it.
      liveClientOptions(),
      {
      },
      // 'extra || {}', not a bare 'extra': struct.merge returns UNDEFINED when the
      // last entry is undefined, and basicSetup is normally called with no
      // argument at all - so a bare 'extra' silently discarded the apikey
      // and server values above and handed the SDK undefined. Harmless
      // while there was nothing in that object; not harmless now.
      extra || {},
      { system: { fetch: transport.fetch } }
    ]))
  }

  const setup = {
    idmap,
    env,
    options,
    client,
    struct,
    data: entityData,
    explain: 'TRUE' === env.QUOTES_TEST_EXPLAIN,
    live,
    transport,
    now: Date.now(),
  }

  return setup
}
  
