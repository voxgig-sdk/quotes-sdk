-- Quotes SDK error

local QuotesError = {}
QuotesError.__index = QuotesError


function QuotesError.new(code, msg, ctx)
  local self = setmetatable({}, QuotesError)
  self.is_sdk_error = true
  self.sdk = "Quotes"
  self.code = code or ""
  self.msg = msg or ""
  self.ctx = ctx
  self.result = nil
  self.spec = nil
  return self
end


function QuotesError:error()
  return self.msg
end


function QuotesError:__tostring()
  return self.msg
end


return QuotesError
