package core

type QuotesError struct {
	IsQuotesError bool
	Sdk              string
	Code             string
	Msg              string
	Ctx              *Context
	Result           any
	Spec             any
}

func NewQuotesError(code string, msg string, ctx *Context) *QuotesError {
	return &QuotesError{
		IsQuotesError: true,
		Sdk:              "Quotes",
		Code:             code,
		Msg:              msg,
		Ctx:              ctx,
	}
}

func (e *QuotesError) Error() string {
	return e.Msg
}
